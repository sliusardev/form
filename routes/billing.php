<?php

use App\Http\Controllers\Billing\WayForPayController;
use App\Http\Controllers\Billing\MonobankController;

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

// Monobank webhook and return endpoints
Route::post('/billing/callback/monobank/webhook', [MonobankController::class, 'webhook'])
    ->name('billing.monobank.webhook')
    ->withoutMiddleware(['csrf']);

Route::match(['get','post'], '/billing/callback/monobank/return/{payment_id}', [MonobankController::class, 'return'])
    ->name('billing.monobank.return');
