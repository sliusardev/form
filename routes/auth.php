<?php


use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Socialite\ProviderCallbackController;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/auth/store', [AuthController::class, 'store'])->name('auth.store');
    Route::post('/auth/login', [AuthController::class, 'auth'])->name('auth.login');


    Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)
        ->name('socialite.auth.redirect');

    Route::get('/auth/{provider}/callback', ProviderCallbackController::class)
        ->name('socialite.auth.callback');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
});
