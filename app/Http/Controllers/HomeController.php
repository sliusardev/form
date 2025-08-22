<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $prices = resolve(PaymentService::class)->preparedPrices();

        $submissionCost = $prices['submissionCost'];
        $formCost = $prices['formCost'];
        $minPayment = $prices['minPayment'];
        $currency = $prices['currency'];

        return view('landing', [
            'submissionCost' => $submissionCost,
            'formCost' => $formCost,
            'minPayment' => $minPayment,
            'currency' => $currency,
        ]);
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function about()
    {
        return view('pages.about');
    }
}
