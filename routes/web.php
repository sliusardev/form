<?php

use App\Http\Controllers\Billing\BillingController;
use App\Http\Controllers\Billing\WayForPayController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\FormSubmissionMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

Route::get('/payment-success', function () {
    return view('pages.payment-success');
})->name('payment-success');

Route::get('/payment-wrong', function () {
    return view('pages.payment-wrong');
})->name('payment-wrong');

Route::prefix('dashboard')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/company', [CompanyController::class, 'show'])->name('company.show');
        Route::put('/company/update', [CompanyController::class, 'update'])->name('company.update');

        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::put('/profile', [UserController::class, 'update'])->name('user.update');
        Route::put('/profile/password', [UserController::class, 'updatePassword'])
            ->name('user.update-password');

        Route::get('/forms', [FormController::class, 'forms'])->name('forms.index');
        Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');
        Route::post('/forms', [FormController::class, 'store'])->name('forms.store');
        Route::get('/forms/{form}/edit', [FormController::class, 'edit'])->name('forms.edit');
        Route::put('/forms/{form}', [FormController::class, 'update'])->name('forms.update');
        Route::delete('/forms/{form}', [FormController::class, 'destroy'])->name('forms.destroy');

        Route::get('/forms/submissions', [SubmissionController::class, 'index'])->name('submissions.index');

        Route::get('/forms/{form}/submissions', [SubmissionController::class, 'formSubmissions'])->
            name('forms.submissions.form');
        Route::get('/submissions/{submission}', [SubmissionController::class, 'show'])->name('submissions.show');

        Route::get('integrations', function () {
            return view('dashboard.integrations');
        })->name('integrations.index');

        Route::get('/billing', [BillingController::class, 'index'])
            ->name('billing.index');

        Route::post('/billing/way-for-pay/pay', [WayForPayController::class, 'pay'])
            ->name('way-for-pay.pay');

        Route::middleware([AdminMiddleware::class])->group(function () {
            Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
            Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
            Route::post('/settings/artisan', [SettingsController::class, 'artisanActions'])
                ->name('settings.artisan');

            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::post('users/login-as', [UserController::class, 'loginAs'])
                ->name('users.login-as');


            Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');


        });
    });

Route::post('/billing/callback/way-for-pay/service-url', [WayForPayController::class, 'serviceUrl'])
    ->name('billing.way-for-pay.service-url')
//    ->middleware('web') // Only web middleware, no auth
    ->withoutMiddleware(['csrf']);  // Important: exclude CSRF for external callbacks

Route::match(['get', 'post'],'/billing/callback/way-for-pay/callback', [WayForPayController::class, 'callback'])
    ->name('billing.way-for-pay.callback');

Route::match(['get', 'post'], '/billing/callback/way-for-pay/return-url', [WayForPayController::class, 'returnUrl'])
    ->name('billing.way-for-pay.return-url');

Route::match(['get', 'post'], 'f/{hash}', [SubmissionController::class, 'store'])
    ->where('hash', '[a-zA-Z0-9]+')
    ->name('forms.store-submission')
    ->middleware([FormSubmissionMiddleware::class]);

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');


require __DIR__.'/auth.php';
