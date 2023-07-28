<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\OTP\OTPController;
use App\Http\Controllers\Image\ImageController;
use App\Http\Controllers\Register\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->as('v1')->group(static function (): void {
    /**
     * Social Login Gamil
     */
    Route::middleware('check.app.key')->post(
        uri: '/google/login',
        action: [AuthController::class, 'login']
    )->name('social:login');

    /**
     * Gmail Register
     */
    Route::middleware('check.app.key')->post(
        uri: '/mail/register',
        action: [AuthController::class, 'register']
    )->name('email:register');

    /**
     * Gmail Login
     */
    Route::middleware('check.app.key')->post(
        uri: '/mail/login',
        action: [AuthController::class, 'mail_login']
    )->name('email:login');
    /**
     * OTP Confirm Controller
     */
    Route::middleware('check.app.key')->post(
        uri: '/otp',
        action: [OTPController::class, 'confirm']
    )->name('email:login');
    /**
     * OTP Resend Controller
     */
    Route::middleware('check.app.key')->post(
        uri: '/otp/resend',
        action: [OTPController::class, 'resend']
    )->name('email:login');

    /**
     * Forget Pasword Controller
     */
    Route::middleware('check.app.key')->post(
        uri: '/password/change',
        action: [AuthController::class, 'password_change']
    )->name('email:login');

    /**
     * Logout
     */
    Route::middleware(['check.app.key', 'auth:sanctum'])->post(
        uri: '/logout',
        action: [AuthController::class, 'logout']
    )->name('email:login');

    /**
     * Test
     */
    Route::middleware(['check.app.key', 'auth:sanctum'])->post(
        uri: '/test',
        action: [AuthController::class, 'test']
    )->name('email:login');

    /**
     * Image Attribut Casting
     */
    Route::get(
        uri: '/{path}',
        action: ImageController::class
    )->name(':show')->where('path', '.+');
});
