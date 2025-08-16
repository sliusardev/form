<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Billing\WayForPayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\FormSubmissionMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::match(['get', 'post'], 'f/{hash}', [SubmissionController::class, 'store'])
    ->where('hash', '[a-zA-Z0-9]+')
    ->name('forms.store-submission')
    ->middleware([FormSubmissionMiddleware::class]);

Route::get('/answer/success', [AnswerController::class, 'success'])->name('answer.success');
Route::get('/answer/error', [AnswerController::class, 'error'])->name('answer.error');

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/billing.php';
