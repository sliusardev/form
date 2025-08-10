<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Models\Payment;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WayForPayService
{
    public function preparePaymentData(Request $request, $company, $productName, $totalCost, $currency): array
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
            'currency' => $currency,
            'productName' => [$productName],
            'productCount' => [1],
            'productPrice' => [$totalCost],
            'clientFirstName' => $company->name,
            'clientPhone' => $company->phone ?? '',
            'clientEmail' => auth()->user()->email,
            'language' => app()->getLocale(),
//            'serviceUrl' => route('billing.way-for-pay.service-url'),
//            'returnUrl' => route('billing.way-for-pay.return-url'),
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
            $currency,
            $productName,
            1,
            $totalCost,
        ]);
        $paymentData['merchantSignature'] = hash_hmac('md5', $signatureString, $merchantSecretKey);

        return $paymentData;
    }

    public function updateCompany(Payment $payment): void
    {
        $order = $payment->order ?? [];

        $company = Company::find($payment->company_id);
        if ($company) {
            $submissionLimit = $order['submission_limit'] ?? 0;
            $formLimit = $order['form_limit'] ?? 0;
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
        $content = $request->getContent();
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('WayForPay POST handleServiceUrl: Invalid JSON received.', ['content' => $content]);
            return response()->json(['reason' => 'Invalid JSON'], 400);
        }

        Log::info('WayForPay POST handleServiceUrl: ', $data);
        $secretKey = config('services.wayforpay.secret_key');

        $signatureString = implode(';', [
            $data['merchantAccount'] ?? '',
            $data['orderReference'] ?? '',
            $data['amount'] ?? '',
            $data['currency'] ?? '',
            $data['authCode'] ?? '',
            $data['cardPan'] ?? '',
            $data['transactionStatus'] ?? '',
            $data['reasonCode'] ?? '',
        ]);

        $expectedSignature = hash_hmac('md5', $signatureString, $secretKey);

        if (($data['merchantSignature'] ?? '') !== $expectedSignature) {
            Log::error('Invalid signature in WayForPay service URL callback', [
                'received' => $data['merchantSignature'] ?? 'not_provided',
                'expected' => $expectedSignature,
                'data' => $data
            ]);
            return response()->json(['reason' => 'Invalid signature'], 403);
        }

        $paymentStatus = $data['transactionStatus'] ?? '';

        $status = PaymentStatusEnum::PENDING;

        if ($paymentStatus === 'Approved') {
            $status = PaymentStatusEnum::PAID;
        }

        if ($paymentStatus === 'Declined') {
            $status = PaymentStatusEnum::FAILED;
        }

        if ($paymentStatus === 'Refunded') {
            $status = PaymentStatusEnum::REFUNDED;
        }

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
            Log::error('Payment failed for orderReference: ' . ($data['orderReference'] ?? 'N/A') . ' - ' . $reason);
        }

        $orderReference = $data['orderReference'] ?? '';
        $time = time();
        $responseSignature = hash_hmac('md5', implode(';', [$orderReference, 'accept', $time]), $secretKey);

        return response()->json([
            'orderReference' => $orderReference,
            'status' => 'accept',
            'time' => $time,
            'signature' => $responseSignature
        ]);
    }


}
