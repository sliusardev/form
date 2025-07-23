<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Models\Payment;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WayForPayService
{
    private const CURRENCY = 'UAH';
    public function preparePaymentData(Request $request, $company, $productName, $totalCost): array
    {
        $orderReference = 'order_' . uniqid();
        $orderDate = time();
        $merchantAccount = config('services.wayforpay.login');
        $merchantSecretKey = config('services.wayforpay.secret_key');
        $merchantDomainName = $request->getHost();

        $paymentData = [
            'merchantAccount' => $merchantAccount,
            'merchantDomainName' => $merchantDomainName,
            'orderReference' => $orderReference,
            'orderDate' => $orderDate,
            'amount' => $totalCost,
            'currency' => self::CURRENCY,
            'productName' => [$productName],
            'productCount' => [1],
            'productPrice' => [$totalCost],
            'clientFirstName' => $company->name,
            'clientEmail' => auth()->user()->email,
            'language' => 'UA',
            'serviceUrl' => route('billing.way-for-pay.service-url'),
            'returnUrl' => route('billing.way-for-pay.return-url'),
//            'callbackUrl' => route('billing.way-for-pay.callback'),
//            'serviceUrl' => 'https://formpost.org/f/q7d5DXLhWekoYoi',
//            'callbackUrl' => 'https://formpost.org/f/oiYfBzCHdrsxkCx',
//            'returnUrl' => 'https://formpost.org/f/DzguzbgKNmSVYNd',
        ];

        $signatureString = implode(';', [
            $merchantAccount,
            $merchantDomainName,
            $orderReference,
            $orderDate,
            $totalCost,
            self::CURRENCY,
            $productName,
            1,
            $totalCost,
        ]);
        $paymentData['merchantSignature'] = hash_hmac('md5', $signatureString, $merchantSecretKey);

        return $paymentData;
    }

    public function handleGetCallback(Request $request): RedirectResponse
    {
        $orderReference = $request->query('orderReference');
        if (!$orderReference) {
            return redirect()->route('company.index')
                ->with('error', 'Payment reference not found. Please contact support.');
        }

        $payment = Payment::where('payment_id', $orderReference)->first();
        if (!$payment) {
            return redirect()->route('billing.index')
                ->with('error', 'Payment not found. Please contact support.');
        }

        // Add a redirect to login if user isn't authenticated
        if (!auth()->check()) {
            // Store a success message in session before redirecting to login
            if ($payment->status->value === 'paid') {
                session()->flash('payment_success', 'Payment completed successfully. Your limits have been updated.');
            }
            return redirect()->route('login')->with('redirect_after_login', route('billing.index'));
        }

        if ($payment->status->value === 'paid') {
            return redirect()->route('billing.index')
                ->with('success', 'Payment completed successfully. Your limits have been updated.');
        } elseif ($payment->status->value === 'pending') {
            return redirect()->route('billing.index')
                ->with('info', 'Your payment is being processed. Limits will be updated once payment is confirmed.');
        } else {
            return redirect()->route('billing.index')
                ->with('error', 'Payment failed. Please try again or contact support.');
        }
    }

    public function handlePostCallback(Request $request): void
    {
        $data = $request->all();
        Log::info('WayForPay POST callback: ', $data);
        $merchantSecretKey = config('services.wayforpay.secret_key');

        $requiredFields = [
            'merchantAccount',
            'orderReference',
            'amount',
            'currency',
            'transactionStatus',
            'reasonCode',
            'merchantSignature'
        ];

        $missingFields = [];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            Log::error('WayForPay POST callback: Missing fields: ' . implode(', ', $missingFields));
            return;
        }

        $signatureFields = [
            $data['merchantAccount'],
            $data['orderReference'],
            $data['amount'],
            $data['currency'],
            $data['authCode'] ?? '',
            $data['cardPan'] ?? '',
            $data['transactionStatus'],
            $data['reasonCode'],
        ];

        $signatureString = implode(';', $signatureFields);
        $expectedSignature = hash_hmac('md5', $signatureString, $merchantSecretKey);

        if ($data['merchantSignature'] !== $expectedSignature) {
            Log::error('Invalid signature in WayForPay callback', [
                'received' => $data['merchantSignature'],
                'expected' => $expectedSignature
            ]);
            return;
        }

        $payment = Payment::query()->where('payment_id', $data['orderReference'])->first();

        $paymentUpdated = $this->paymentUpdated($payment, $data);
        Log::info('Payment update result: ' . ($paymentUpdated ? 'success' : 'failed'));

        if ($paymentUpdated) {
            $this->updateCompany($payment, $data);
        }
    }

    public function paymentUpdated($payment, $data): bool
    {
        if (!$payment) {
            Log::error('Payment not found for orderReference: ' . $data['orderReference']);
            return false;
        }

        if ($payment->status->value === 'paid') {
            Log::error('Payment already processed.');
            return false;
        }

        if ($data['transactionStatus'] !== 'Approved') {
            $payment->status = PaymentStatusEnum::FAILED;
            $payment->save();
            $reason = $data['reason'] ?? ($data['reasonCode'] ?? 'Unknown error');
            Log::error('Payment failed: ' . $reason);
            return false;
        }

        $payment->status = PaymentStatusEnum::PAID;
        $payment->save();

        return true;
    }

    public function updateCompany(Payment $payment): void
    {
        $company = Company::find($payment->company_id);
        if ($company) {
            $submissionLimit = $payment->payload['submission_limit'] ?? 0;
            $formLimit = $payment->payload['form_limit'] ?? 0;
            $company->submission_limit += $submissionLimit;
            $company->form_limit += $formLimit;
            $company->save();

            Log::info('Company limits updated', [
                'company_id' => $company->id,
                'submission_limit' => $submissionLimit,
                'form_limit' => $formLimit
            ]);
        } else {
            Log::error('Company not found for payment', ['company_id' => $payment->company_id]);
        }
    }

    public function handleServiceUrl(Request $request): JsonResponse
    {
        $data = $request->all();
        Log::info('WayForPay POST handleServiceUrl: ', $data);
        $secretKey = config('services.wayforpay.secret_key');

        $expected = base64_encode(hash_hmac('md5', implode(';', [
            $data['merchantAccount'],
            $data['orderReference'],
            $data['amount'],
            $data['currency'],
            $data['authCode'],
            $data['cardPan'],
            $data['transactionStatus'],
            $data['reasonCode'],
        ]), $secretKey));

        if ($data['merchantSignature'] !== $expected) {
            return response()->json(['reason' => 'Invalid signature'], 403);
        }

        $status = $data['transactionStatus'] === 'Approved' ? PaymentStatusEnum::PAID : PaymentStatusEnum::FAILED;

        $payment = Payment::query()->where('payment_id', $data['orderReference'])->first();

        if ($payment && $status == PaymentStatusEnum::PAID) {
            $this->updateCompany($payment);
        }

        if ($payment) {
            $payment->update([
                'status' => $status,
                'payload' => $data,
            ]);
        }

        Log::info('WayForPay serviceUrl processed', [
            'orderReference' => $data['orderReference'],
            'status' => $status->value,
        ]);

        if ($status == PaymentStatusEnum::FAILED) {
            $reason = $data['reason'] ?? ($data['reasonCode'] ?? 'Unknown error');
            Log::error('Payment failed for orderReference: ' . $data['orderReference'] . ' - ' . $reason);
        }

        return response()->json([
            'orderReference' => $data['orderReference'],
            'status' => 'accept',
        ]);
    }


}
