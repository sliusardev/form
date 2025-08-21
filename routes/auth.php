<?php


use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Socialite\ProviderCallbackController;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/auth/store', [AuthController::class, 'store'])->name('auth.store');
    Route::post('/auth/login', [AuthController::class, 'auth'])->name('auth.login');

    Route::get('/app/register', function () {
        return redirect('/register');
    });

    Route::get('/app/login', function () {
        return redirect('/login');
    });

    Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)
        ->name('socialite.auth.redirect');

    Route::get('/auth/{provider}/callback', ProviderCallbackController::class)
        ->name('socialite.auth.callback');

    // Forgot Password Routes
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->middleware('guest')->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

    // Email Verification Routes
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard')->with('status', 'Your email has been verified!');
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', __('dashboard.verification_link_sent'));
    })->middleware(['throttle:6,1'])->name('verification.send');
});
