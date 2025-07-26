<?php

namespace App\Services;

use App\Enums\PaymentProviderEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Company;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function init(
        string $provider,
        array $paymentData,
        int $totalCost,
        string $currency,
        Company $company,
        array $order
    ) {
        try {
            Payment::query()->create([
                'provider' => $provider,
                'payment_id' => $paymentData['orderReference'],
                'amount' => $totalCost,
                'currency' => $currency,
                'status' => PaymentStatusEnum::PENDING,
                'payload' => $paymentData,
                'company_id' => $company->id,
                'user_id' => auth()->id(),
                'order' => $order,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save payment: ' . $e->getMessage());
            return back()->with('error', 'Failed to process payment. Please try again.');
        }
    }
}
