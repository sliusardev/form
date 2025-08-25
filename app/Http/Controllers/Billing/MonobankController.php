<?php

namespace App\Http\Controllers\Billing;

use App\Enums\PaymentProviderEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillingRequest;
use App\Models\Payment;
use App\Services\MonobankService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class MonobankController extends Controller
{
    public function pay(BillingRequest $request)
    {
        $prices = resolve(PaymentService::class)->preparedPrices();
        $submissionCost = $prices['submissionCost'];
        $formCost = $prices['formCost'];
        $minPayment = $prices['minPayment'];
        $currency = $prices['currency'];

        $company = selectedCompany();
        $submissionLimit = (int) $request->input('submission_limit');
        $formLimit = (int) $request->input('form_limit');
        $totalCost = ($submissionLimit * $submissionCost) + ($formLimit * $formCost);

        if ($totalCost < $minPayment) {
            return back()->withErrors(['total_cost' => 'Minimum payment is ' . $minPayment . ' ' . $currency]);
        }

        $productName = trans('dashboard.billing') .': '
            . $submissionLimit  . ' ' . trans('dashboard.submissions') . ', '
            . $formLimit  . ' '  . trans('dashboard.forms');

        $invoice = resolve(MonobankService::class)
            ->createInvoice($request, $company, $productName, $totalCost, $currency);

        if (isset($invoice['error']) || empty($invoice['invoiceId']) || empty($invoice['pageUrl'])) {
            return back()->with('error', __('dashboard.failed_process_payment'));
        }

        $paymentData = [
            'invoiceId' => $invoice['invoiceId'],
            'orderReference' => $invoice['invoiceId'], // align with PaymentService expectation
            'pageUrl' => $invoice['pageUrl'],
            'submission_limit' => $submissionLimit,
            'form_limit' => $formLimit,
        ];

        $order = [
            'productName' => $productName,
            'submission_limit' => $submissionLimit,
            'form_limit' => $formLimit,
        ];

        resolve(PaymentService::class)->init(
            PaymentProviderEnum::MONOBANK->value,
            $paymentData,
            (int) round($totalCost),
            $currency,
            $company,
            $order
        );

        return redirect()->away($invoice['pageUrl']);
    }

    public function webhook(Request $request)
    {
        dump('webhook', $request->all(), $request->getMethod());
        return resolve(MonobankService::class)->handleWebhook($request);
    }

    public function return(Request $request)
    {
        $invoiceId = $request->get('invoiceId') ?? $request->get('orderReference');
        if (!$invoiceId) {
            return view('pages.payment-result', [
                'status' => 'error',
                'message' => 'Платіж не знайдено.',
            ]);
        }

        $payment = Payment::query()->where('payment_id', $invoiceId)->first();

        if (!$payment) {
            return view('pages.payment-result', [
                'status' => 'error',
                'message' => 'Платіж не знайдено.',
            ]);
        }

        if ($payment->status === PaymentStatusEnum::PAID) {
            return view('pages.payment-result', [
                'status' => 'success',
                'message' => 'Оплата пройшла успішно!',
            ]);
        }

        return view('pages.payment-result', [
            'status' => 'failed',
            'message' => 'Оплата не вдалася.',
        ]);
    }
}
