<?php

use App\Http\Controllers\Billing\BillingController;
use App\Http\Controllers\Billing\WayForPayController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\FormSubmissionMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/payment-success', function () {
    return view('pages.payment-success');
})->name('payment-success');

Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
        Route::put('/company', [CompanyController::class, 'update'])->name('company.update');

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

        Route::get('/billing/callback/way-for-pay/show-status', [WayForPayController::class, 'showStatus'])
            ->name('billing.way-for-pay.show-status');

        Route::middleware([AdminMiddleware::class])->group(function () {
            Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
            Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
        });
    });

Route::post('/billing/callback/way-for-pay/update-status', [WayForPayController::class, 'updateStatus'])
    ->name('billing.way-for-pay.update-status')
    ->middleware('web') // Only web middleware, no auth
    ->withoutMiddleware(['csrf']);  // Important: exclude CSRF for external callbacks

Route::match(['get', 'post'],'/billing/callback/way-for-pay/callback', [WayForPayController::class, 'callback'])
    ->name('billing.way-for-pay.callback')
    ->middleware('web')  // Only web middleware, no auth
    ->withoutMiddleware(['csrf']);

Route::post('f/{hash}', [SubmissionController::class, 'store'])
    ->where('hash', '[a-zA-Z0-9]+')
    ->name('forms.store-submission')
    ->middleware([FormSubmissionMiddleware::class]);


require __DIR__.'/auth.php';

