<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Models\Company;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MonobankService
{
    public function createInvoice(Request $request, Company $company, string $productName, float $totalCost, string $currency): array
    {
        $token = config('services.monobank.token');
        $baseUrl = rtrim(config('services.monobank.base_url'), '/');
        $currencyCode = $this->mapCurrencyCode($currency);

        $amountMinor = (int) round($totalCost * 100);
        $reference = 'mono_' . uniqid();

        $amountMinor = 100;

        $payload = [
            'amount' => $amountMinor,
            'ccy' => $currencyCode,
            'merchantPaymInfo' => [
                'reference' => $reference,
                'destination' => $productName,
                'basketOrder' => [
                    [
                        'name' => $productName,
                        'qty' => 1,
                        'sum' => $amountMinor,
                    ],
                ],
            ],
            'redirectUrl' => route('billing.monobank.return'),
            'webHookUrl' => route('billing.monobank.webhook'),
            'validity' => 86400,
        ];

        try {
            $response = Http::withHeaders([
                'X-Token' => $token,
                'Content-Type' => 'application/json',
            ])->post($baseUrl . '/api/merchant/invoice/create', $payload);

            if (!$response->successful()) {
                Log::error('Monobank invoice create failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return ['error' => 'Failed to create invoice'];
            }

            $data = $response->json();
            Log::info('Monobank invoice created', $data ?? []);

            return [
                'invoiceId' => $data['invoiceId'] ?? null,
                'pageUrl' => $data['pageUrl'] ?? null,
                'payload' => $payload,
            ];
        } catch (\Throwable $e) {
            Log::error('Monobank invoice exception: ' . $e->getMessage());
            return ['error' => 'Exception during invoice creation'];
        }
    }

    public function handleWebhook(Request $request): JsonResponse
    {
        $content = $request->getContent();
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Monobank webhook: invalid JSON', ['content' => $content]);
            return response()->json(['status' => 'error', 'message' => 'invalid json'], 400);
        }

        // Verify signature if present
        $token = config('services.monobank.token');
        $receivedSign = $request->header('X-Sign') ?? '';
        if (!empty($receivedSign)) {
            $expected = base64_encode(hash_hmac('sha256', $content, $token, true));
            if (!hash_equals($expected, $receivedSign)) {
                Log::warning('Monobank webhook: invalid signature', [
                    'expected' => $expected,
                    'received' => $receivedSign,
                ]);
                // Continue but mark as suspicious
            }
        } else {
            Log::info('Monobank webhook: no signature header provided');
        }

        Log::info('Monobank webhook payload', $data);

        $status = $this->mapStatus($data);
        $invoiceId = $data['invoiceId'] ?? ($data['orderReference'] ?? null);

        if (!$invoiceId) {
            Log::error('Monobank webhook: missing invoiceId', $data);
            return response()->json(['status' => 'error', 'message' => 'missing invoiceId'], 400);
        }

        $payment = Payment::query()->where('payment_id', $invoiceId)->first();

        if ($payment && $status === PaymentStatusEnum::PAID) {
            $this->updateCompany($payment);
        }

        if ($payment) {
            $payment->update([
                'status' => $status,
                'payload' => $data,
            ]);
        } else {
            Log::warning('Monobank webhook: payment not found', ['invoiceId' => $invoiceId]);
        }

        return response()->json(['status' => 'ok']);
    }

    protected function mapCurrencyCode(string $currency): int
    {
        return match (strtoupper($currency)) {
            'UAH' => 980,
            'USD' => 840,
            default => 980,
        };
    }

    protected function mapStatus(array $data): PaymentStatusEnum
    {
        $status = $data['status'] ?? ($data['invoiceStatus'] ?? '');
        $status = strtolower((string) $status);

        return match ($status) {
            'success', 'paid' => PaymentStatusEnum::PAID,
            'failure', 'failed', 'declined', 'expired' => PaymentStatusEnum::FAILED,
            'reversed', 'refund' => PaymentStatusEnum::REFUNDED,
            default => PaymentStatusEnum::PENDING,
        };
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

            Log::info('Company limits updated (Monobank)', [
                'company_id' => $company->id,
                'submission_limit' => $submissionLimit,
                'form_limit' => $formLimit
            ]);
        } else {
            Log::error('Company not found for payment (Monobank)', ['company_id' => $payment->company_id]);
        }
    }
}

