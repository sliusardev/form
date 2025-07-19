<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Services\WayForPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Enums\PaymentProviderEnum;

class BillingController extends Controller
{
    private const MIN_PAYMENT = 50;
    private const SUBMISSION_COST = 0.05;
    private const FORM_COST = 10;
    private const CURRENCY = 'UAH';

    public function index()
    {
        $company = selectedCompany();

        return view('dashboard.billing.index', [
            'company' => $company,
            'currency' => self::CURRENCY,
            'submissionOne' => self::SUBMISSION_COST,
            'formOne' => self::FORM_COST,
            'minPayment' => self::MIN_PAYMENT,
        ]);
    }

    public function submission()
    {
        return view('dashboard.billing.submission');
    }

    public function pay(Request $request)
    {
        $request->validate([
            'submission_limit' => 'required|integer|min:0',
            'form_limit' => 'required|integer|min:0',
        ], [
            'submission_limit.required' => 'Submission limit is required.',
            'form_limit.required' => 'Form limit is required.',
        ]);

        $company = selectedCompany();
        $submissionLimit = $request->input('submission_limit');
        $formLimit = $request->input('form_limit');
        $totalCost = ($submissionLimit * self::SUBMISSION_COST) + ($formLimit * self::FORM_COST);

//        if ($totalCost < self::MIN_PAYMENT) {
//            return back()->withErrors(['total_cost' => 'Minimum payment is ' . self::MIN_PAYMENT . ' ' . self::CURRENCY]);
//        }

        $productName = 'Billing Top-up: ' . $submissionLimit . ' submissions, ' . $formLimit . ' forms';

        $paymentData = resolve(WayForPayService::class)
            ->preparePaymentData($request, $company, $productName, $totalCost);

        $paymentData['submission_limit'] = $submissionLimit;
        $paymentData['form_limit'] = $formLimit;

        resolve(PaymentService::class)->init(
            PaymentProviderEnum::WAYFORPAY->value,
            $paymentData,
            $totalCost,
            self::CURRENCY,
            $company
        );

        $wayforpayUrl = 'https://secure.wayforpay.com/pay';
        return view('dashboard.billing.wayforpay_redirect', compact('wayforpayUrl', 'paymentData'));
    }

    public function wayforpayCallback(Request $request)
    {
        Log::info('WayForPay Callback Request: ', $request->all());

        if ($request->isMethod('get')) {
            return resolve(WayForPayService::class)->handleGetCallback($request);
        }

        return resolve(WayForPayService::class)->handlePostCallback($request);
    }
}
