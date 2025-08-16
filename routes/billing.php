<?php

use App\Http\Controllers\Billing\WayForPayController;

Route::post('/billing/callback/way-for-pay/service-url', [WayForPayController::class, 'serviceUrl'])
    ->name('billing.way-for-pay.service-url')
    ->withoutMiddleware(['csrf']);  // Important: exclude CSRF for external callbacks

Route::match(['get', 'post'], '/billing/callback/way-for-pay/return-url', [WayForPayController::class, 'returnUrl'])
    ->name('billing.way-for-pay.return-url');

Route::get('/payment-success', [WayForPayController::class, 'approvedPayment'])
    ->name('payment-success')
    ->withoutMiddleware(['csrf']);

Route::get('/payment-wrong', [WayForPayController::class, 'declinedPayment'])
    ->name('payment-wrong')
    ->withoutMiddleware(['csrf']);
