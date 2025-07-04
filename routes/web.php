<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

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
    });

Route::post('f/{hash}', [SubmissionController::class, 'store'])
    ->where('hash', '[a-zA-Z0-9]+')
    ->name('forms.store-submission');


require __DIR__.'/auth.php';
