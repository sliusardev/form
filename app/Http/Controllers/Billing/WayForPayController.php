<?php

namespace App\Http\Controllers\Billing;

use App\Enums\PaymentProviderEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillingRequest;
use App\Models\Payment;
use App\Services\PaymentService;
use App\Services\WayForPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WayForPayController extends Controller
{
    public function pay(BillingRequest $request)
    {
        $prices = resolve(PaymentService::class)->preparedPrices();
        $submissionCost = $prices['submissionCost'];
        $formCost = $prices['formCost'];
        $minPayment = $prices['minPayment'];
        $currency = $prices['currency'];

        $wayforpayUrl = 'https://secure.wayforpay.com/pay';

        $company = selectedCompany();
        $submissionLimit = $request->input('submission_limit');
        $formLimit = $request->input('form_limit');
        $totalCost = ($submissionLimit * $submissionCost) + ($formLimit * $formCost);

        if ($totalCost < $minPayment) {
            return back()->withErrors(['total_cost' => 'Minimum payment is ' . $minPayment . ' ' . $currency]);
        }

        $totalCost = 1;

        $productName = trans('dashboard.billing') .': '
            . $submissionLimit  . ' ' . trans('dashboard.submissions') . ', '
            . $formLimit  . ' '  . trans('dashboard.forms');

        $paymentData = resolve(WayForPayService::class)
            ->preparePaymentData(
                $request,
                $company,
                $productName,
                $totalCost,
                $currency
            );

        $paymentData['submission_limit'] = $submissionLimit;
        $paymentData['form_limit'] = $formLimit;

        $order = [
            'productName' => $productName,
            'submission_limit' => $submissionLimit,
            'form_limit' => $formLimit,
        ];

        resolve(PaymentService::class)->init(
            PaymentProviderEnum::WAYFORPAY->value,
            $paymentData,
            $totalCost,
            $currency,
            $company,
            $order
        );

        return view('dashboard.billing.wayforpay_redirect', compact(
            'wayforpayUrl',
            'paymentData'
        ));
    }

    public function serviceUrl(Request $request)
    {
        \Log::info('WayForPay serviceUrl Request: ', $request->all());
        return resolve(WayForPayService::class)->handleServiceUrl($request);
    }

    public function returnUrl(Request $request)
    {
        \Log::info('WayForPay returnUrl Request: ', $request->all());
        \Log::info('Method: '. $request->getMethod());
        $orderId = $request->get('orderReference'); // іноді передається в URL
        $payment = Payment::query()->where('payment_id', $orderId)->first();

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

    public function approvedPayment(Request $request)
    {
        return response()->redirectToRoute('billing.index')->with('success', 'Оплата пройшла успішно!');
    }

    public function declinedPayment(Request $request)
    {
        return response()->redirectToRoute('billing.index')->with('error', 'Оплата не вдалася. Будь ласка, спробуйте ще раз.');
    }
}
