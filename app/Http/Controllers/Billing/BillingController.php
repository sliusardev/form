<?php

namespace App\Http\Controllers\Billing;

use App\Enums\CurrenciesEnum;
use App\Http\Controllers\Controller;
use App\Services\PaymentService;

class BillingController extends Controller
{
    public function index()
    {
        $company = selectedCompany();
        $prices = resolve(PaymentService::class)->preparedPrices();
        $submissionCost = $prices['submissionCost'];
        $formCost = $prices['formCost'];
        $minPayment = $prices['minPayment'];
        $currency = $prices['currency'];

        return view('dashboard.billing.index', [
            'company' => $company,
            'currency' => $currency,
            'submissionOne' => $submissionCost,
            'formOne' => $formCost,
            'minPayment' => $minPayment,
        ]);
    }
}
