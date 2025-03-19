<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ScholarshipManagementController;
use Illuminate\Http\Request;
use App\Models\User;


Route::get('/', function () {
    return view('welcome');
    // return view('closed');
})->name('welcome');

if(app()->environment('production')){URL::forceScheme('https');}

    Route::middleware('auth')->group(function () {
        // Dashboard
        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/submission', [ApplicationController::class, 'submission'])->name('submission.index');

        // Dashboard (accessible only to verified users)
        Route::get('/dashboard', [DashboardController::class, 'index'])
        //  ->middleware('verified')
        ->name('dashboard');

        //Administration
        Route::get('/scholarship', [ScholarshipManagementController::class, 'index'])->name('scholarship.index');
        //Update scholarship
        Route::put('/scholarship/update/{id}', [ScholarshipManagementController::class, 'update'])->name('scholarship.update');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        //Application
        Route::get('/apply/{step?}', [ApplicationController::class, 'index'])->name('apply.index');
        Route::post('/apply/{step}', [ApplicationController::class, 'store'])->name('apply.post');   
    });

    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset-form/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::put('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Document Upload
    Route::post('/docupload', [FileUploadController::class, 'uploadFile'])->name('file.upload');

    Auth::routes([
        'reset' => false, // Disables Laravel’s built-in reset routes
        'verify' => false, // if you still want email verification
    ]);

    Route::get('/verify-email', function () {
    return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard')->with('success', 'Your email has been verified. You can now log in.');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    require __DIR__.'/auth.php';

   




