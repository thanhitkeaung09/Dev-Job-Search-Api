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
     * Job Route
     */

    Route::prefix('job')->as(':job')->middleware(['check.app.key', 'auth:sanctum'])->group(
        base_path('/routes/v1/user/job.php')
    );

    /**
     * Job Applying Route
     */

    Route::prefix('apply')->as(':apply')->middleware(['check.app.key', 'auth:sanctum'])->group(
        base_path('/routes/v1/user/apply.php')
    );

    /**
     * Forger Password Controller
     */

     Route::prefix('forget')->as(':forget')->middleware(['check.app.key', 'auth:sanctum'])->group(
        base_path('/routes/v1/user/forget.php')
    );

    /**
     * Profile
     */

    Route::prefix('profile')->as(':profile')->middleware(['check.app.key', 'auth:sanctum'])->group(
        base_path('/routes/v1/user/profile.php')
    );

    /**
     * Admin Route Authentication
     */
    Route::prefix('admin')->as(':admin')->middleware('check.app.key')->group(
        base_path('/routes/v1/admin/auth.php')
    );

    /**
     * Image Attribut Casting
     */
    Route::get(
        uri: '/{path}',
        action: ImageController::class
    )->name(':show')->where('path', '.+');
});
