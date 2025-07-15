<?php
namespace App\Services;

use App\Models\Subscription;
use Carbon\Carbon;

class LiqPayService
{
    protected mixed $publicKey;
    protected mixed $privateKey;

    public function __construct()
    {
        $this->publicKey = config('services.liqpay.public_key');
        $this->privateKey = config('services.liqpay.private_key');
    }

    public function generatePaymentData($subscription): array
    {
        $plan = $subscription->billingPlan;

        $params = [
            'action' => 'pay',
            'amount' => $plan->price,
            'currency' => 'UAH',
            'description' => "Subscription to {$plan->name} plan ({$plan->billing_cycle})",
            'order_id' => $subscription->liqpay_order_id,
            'version' => '3',
            'public_key' => $this->publicKey,
            'result_url' => route('payment.callback', $subscription->id),
            'server_url' => route('payment.webhook'),
        ];

        $data = base64_encode(json_encode($params));
        $signature = base64_encode(sha1($this->privateKey . $data . $this->privateKey, true));

        return [
            'data' => $data,
            'signature' => $signature
        ];
    }

    public function validateCallback($data, $signature)
    {
        $decodedData = json_decode(base64_decode($data), true);
        $expectedSignature = base64_encode(sha1($this->privateKey . $data . $this->privateKey, true));

        return $signature === $expectedSignature ? $decodedData : false;
    }

    public function processSuccessfulPayment(Subscription $subscription): void
    {
        $subscription->status = 'active';
        $subscription->starts_at = now();
        $subscription->current_period_ends_at = $subscription->billingPlan->getBillingPeriodInDays();
        $subscription->save();
    }

    public function cancelSubscription(Subscription $subscription)
    {
        // Prepare parameters for LiqPay API call
        $params = [
            'action' => 'unsubscribe',
            'version' => '3',
            'public_key' => $this->publicKey,
            'order_id' => $subscription->liqpay_order_id
        ];

        // Encode parameters and generate signature
        $data = base64_encode(json_encode($params));
        $signature = base64_encode(sha1($this->privateKey . $data . $this->privateKey, true));

        // Make HTTP request to LiqPay API using Laravel's HTTP client
        try {
            $response = \Illuminate\Support\Facades\Http::post('https://www.liqpay.ua/api/request', [
                'data' => $data,
                'signature' => $signature
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                // If the API call was successful, update the subscription in our database
                if (isset($responseData['status']) && $responseData['status'] === 'success') {
                    $subscription->auto_renew = false;
                    $subscription->expires_at = $subscription->current_period_ends_at;
                    $subscription->save();

                    return [
                        'success' => true,
                        'message' => 'Subscription successfully canceled'
                    ];
                }

                // Return error with the response message if available
                return [
                    'success' => false,
                    'message' => $responseData['err_description'] ?? 'Failed to cancel subscription'
                ];
            }

            return [
                'success' => false,
                'message' => 'LiqPay API request failed: ' . $response->status()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error connecting to LiqPay: ' . $e->getMessage()
            ];
        }
    }
}
