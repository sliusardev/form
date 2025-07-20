<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    public function index()
    {
        $company = selectedCompany();
        $settings = settings();
        $submissionCost = $settings['one_submission_cost_uah'];
        $formCost = $settings['one_form_cost_uah'];
        $minPayment = $settings['min_payment_uah'];
        $currency = 'UAH';

        return view('dashboard.billing.index', [
            'company' => $company,
            'currency' => $currency,
            'submissionOne' => $submissionCost,
            'formOne' => $formCost,
            'minPayment' => $minPayment,
        ]);
    }
}
