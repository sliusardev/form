<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Models\Payment;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WayForPayService
{
    private const MIN_PAYMENT = 50;
    private const SUBMISSION_COST = 0.05;
    private const FORM_COST = 10;
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
            'callbackUrl' => route('billing.wayforpay.callback'),
            'serviceUrl' => route('billing.wayforpay.callback'),
            'returnUrl' => route('billing.wayforpay.callback'),
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

    public function handleGetCallback(Request $request): \Illuminate\Http\RedirectResponse
    {
        $orderReference = $request->query('orderReference');
        if (!$orderReference) {
            // Always redirect to a public page, never to login
            return redirect()->route('company.index')
                ->with('error', 'Payment reference not found. Please contact support.');
        }

        $payment = Payment::where('payment_id', $orderReference)->first();
        if (!$payment) {
            return redirect()->route('billing.index')
                ->with('error', 'Payment not found. Please contact support.');
        }

        // No session/auth required, always redirect to company.index
        if ($payment->status->value === 'paid') {
            return redirect()->route('company.index')
                ->with('success', 'Payment completed successfully. Your limits have been updated.');
        } elseif ($payment->status->value === 'pending') {
            return redirect()->route('company.index')
                ->with('info', 'Your payment is being processed. Limits will be updated once payment is confirmed.');
        } else {
            return redirect()->route('company.index')
                ->with('error', 'Payment failed. Please try again or contact support.');
        }
    }

    public function handlePostCallback(Request $request)
    {
        $data = $request->all();
        $merchantSecretKey = config('services.wayforpay.secret_key');

        // Remove strict requiredFields check for authCode/cardPan
        $requiredFields = [
            'merchantAccount',
            'orderReference',
            'amount',
            'currency',
            'transactionStatus',
            'reasonCode',
            'merchantSignature'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                Log::error('WayForPay POST callback: Missing field ' . $field);
                return response(['reason' => 'Missing field: ' . $field], 400);
            }
        }
        $signatureFields = [
            $data['merchantAccount'] ?? '',
            $data['orderReference'] ?? '',
            $data['amount'] ?? '',
            $data['currency'] ?? '',
            $data['authCode'] ?? '',
            $data['cardPan'] ?? '',
            $data['transactionStatus'] ?? '',
            $data['reasonCode'] ?? '',
        ];
        $signatureString = implode(';', $signatureFields);
        $expectedSignature = hash_hmac('md5', $signatureString, $merchantSecretKey);
        if (($data['merchantSignature'] ?? '') !== $expectedSignature) {
            return redirect()->route('company.index')->with('error', 'Invalid signature');
        }

        $payment = Payment::where('payment_id', $data['orderReference'])->first();

        if (!$payment) {
            return redirect()->route('company.index')->with('error', 'Payment not found');
        }

        if ($payment->status->value === 'paid') {
            return redirect()->route('company.index')->with('success', 'Payment already processed.');
        }

        if ($data['transactionStatus'] !== 'Approved') {
            $payment->status = PaymentStatusEnum::FAILED;
            $payment->save();
            $reason = $data['reason'] ?? ($data['reasonCode'] ?? 'Unknown error');
            return redirect()->route('company.index')->with('error', 'Payment failed: ' . $reason);
        }


        $payment->status = PaymentStatusEnum::PAID;
        $payment->save();

        // Update company limits after successful payment
        $company = Company::find($payment->company_id);
        if ($company) {
            $submissionLimit = $payment->payload['submission_limit'] ?? 0;
            $formLimit = $payment->payload['form_limit'] ?? 0;
            $company->submission_limit += $submissionLimit;
            $company->form_limit += $formLimit;
            $company->save();
        }

        return redirect()->route('company.index')
            ->with('success', 'Payment completed successfully. Your limits have been updated.');

    }

}
