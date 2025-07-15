<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\LiqPayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(public LiqPayService $liqPayService)
    {

    }

    public function callback(Request $request, $subscriptionId)
    {
        $subscription = Subscription::query()->where('id',$subscriptionId)->first();

        if ($request->has('data') && $request->has('signature')) {
            $data = $request->input('data');
            $signature = $request->input('signature');

            $callbackData = $this->liqPayService->validateCallback($data, $signature);

            if ($callbackData && $callbackData['status'] === 'success') {
                $this->liqPayService->processSuccessfulPayment($subscription);
                return redirect()->route('my-subscription')
                    ->with('success', 'Your subscription has been activated successfully!');
            }
        }

        return redirect()->route('my-subscription')
            ->with('error', 'Payment verification failed. Please contact support.');
    }

    public function webhook(Request $request)
    {
        \Log::info('LiqPay webhook received', $request->all());

        try {
            if ($request->has('data') && $request->has('signature')) {
                $data = $request->input('data');
                $signature = $request->input('signature');

                $callbackData = $this->liqPayService->validateCallback($data, $signature);
                \Log::info('LiqPay webhook data decoded', $callbackData ?: ['error' => 'Invalid callback data']);

                if ($callbackData) {
                    $orderId = $callbackData['order_id'];
                    $subscription = Subscription::query()->where('liqpay_order_id', $orderId)->first();

                    if ($subscription) {
                        if ($callbackData['status'] === 'success') {
                            \Log::info("Processing payment for subscription {$subscription->id}");
                            $this->liqPayService->processSuccessfulPayment($subscription);
                            \Log::info("Payment processed successfully for subscription {$subscription->id}");
                        } else {
                            \Log::warning("Payment not successful. Status: {$callbackData['status']}");
                        }
                    } else {
                        \Log::warning("Subscription not found for order ID: {$orderId}");
                    }

                    // Wait a moment before responding to ensure LiqPay registers the response
                    sleep(1);
                    return response('ok', 200);
                }
            }

            \Log::error('Invalid webhook data format', $request->all());
            return response('error', 400);
        } catch (\Exception $e) {
            \Log::error('Webhook processing error: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            return response('error', 500);
        }
    }
}
