<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $company = selectedCompany();
        $currency = 'UAH';
        $submissionOne = 0.05;
        $formOne = 10;
        $minPayment = 50;
        return view('dashboard.billing.index', compact(
            'company',
            'currency',
            'submissionOne',
            'formOne',
            'minPayment'
        ));
    }

    /**
     * Display the billing page.
     *
     * @return \Illuminate\View\View
     */
    public function submission()
    {
        return view('dashboard.billing.submission');
    }
}
