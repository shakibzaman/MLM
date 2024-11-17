<?php

use App\Http\Controllers\Customer\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Customer\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Customer\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Customer\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Customer\Auth\NewPasswordController;
use App\Http\Controllers\Customer\Auth\PasswordController;
use App\Http\Controllers\Customer\Auth\PasswordResetLinkController;
use App\Http\Controllers\Customer\Auth\RegisteredUserController;
use App\Http\Controllers\Customer\Auth\VerifyEmailController;
use App\Http\Middleware\RedirectIfNotApplicant;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('user.login');
Route::get('user/register', [RegisteredUserController::class, 'create'])
    ->name('user.customer.register.create');
Route::get('user/forget-password', [AuthenticatedSessionController::class, 'forgetPassword'])
    ->name('customer.forget.password');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('customer.login');
Route::get('check-email', [AuthenticatedSessionController::class, 'checkEmail'])->name('customer.email.check');
Route::get('check-username', [AuthenticatedSessionController::class, 'checkUserName'])->name('customer.username.check');

Route::post('member/register', [RegisteredUserController::class, 'memberStore'])->name('member.register');
Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('user.password.store');
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('user.password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('user.password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::prefix('user')->middleware('guest:customer')->name('user.')->group(function () {


    Route::post('register', [RegisteredUserController::class, 'store'])->name('customer.register');
});

Route::prefix('user')->middleware(['auth:customer',RedirectIfNotApplicant::class])->name('user.')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class,'show'])
        ->name('customer.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('customer.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
