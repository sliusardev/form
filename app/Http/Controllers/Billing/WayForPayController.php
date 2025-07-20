<?php

namespace App\Http\Controllers\Billing;

use App\Enums\PaymentProviderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillingRequest;
use App\Services\PaymentService;
use App\Services\WayForPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WayForPayController extends Controller
{
    public function pay(BillingRequest $request)
    {
        $settings = settings();

        $submissionCost = $settings['one_submission_cost_uah'];
        $formCost = $settings['one_form_cost_uah'];
        $minPayment = $settings['min_payment_uah'];
        $currency = 'UAH';
        $wayforpayUrl = 'https://secure.wayforpay.com/pay';

        $company = selectedCompany();
        $submissionLimit = $request->input('submission_limit');
        $formLimit = $request->input('form_limit');
        $totalCost = ($submissionLimit * $submissionCost) + ($formLimit * $formCost);
        $totalCost = 1;

        if ($totalCost < $minPayment) {
            return back()->withErrors(['total_cost' => 'Minimum payment is ' . $minPayment . ' ' . $currency]);
        }

        $productName = trans('dashboard.billing') .': '
            . $submissionLimit  . ' ' . trans('dashboard.submissions') . ', '
            . $formLimit  . ' '  . trans('dashboard.forms');

        $paymentData = resolve(WayForPayService::class)
            ->preparePaymentData(
                $request,
                $company,
                $productName,
                $totalCost
            );

        $paymentData['submission_limit'] = $submissionLimit;
        $paymentData['form_limit'] = $formLimit;

        resolve(PaymentService::class)->init(
            PaymentProviderEnum::WAYFORPAY->value,
            $paymentData,
            $totalCost,
            $currency,
            $company
        );

        return view('dashboard.billing.wayforpay_redirect', compact(
            'wayforpayUrl',
            'paymentData'
        ));
    }

    public function updateStatus(Request $request)
    {
        \Log::info('WayForPay updateStatus Request: ', $request->all());
        resolve(WayForPayService::class)->handlePostCallback($request);
    }

    public function showStatus(Request $request)
    {
        \Log::info('WayForPay showStatus Request: ', $request->all());
        return resolve(WayForPayService::class)->handleGetCallback($request);
    }

    public function callback(Request $request)
    {
        Log::info('WayForPay Callback Request: ', $request->all());

        if ($request->isMethod('get')) {
            Log::info('WayForPay get');
            return resolve(WayForPayService::class)->handleGetCallback($request);
        }

        resolve(WayForPayService::class)->handlePostCallback($request);

        return response()->redirectToRoute('payment-success');
    }
}
