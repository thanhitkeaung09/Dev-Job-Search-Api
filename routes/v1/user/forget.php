<?php 

declare(strict_types=1);

use App\Http\Controllers\ForgetPassword\ForgetPasswordController;
use Illuminate\Support\Facades\Route;

/**
 * Forget Code Resend
 */

Route::post(
    uri : '/',
    action : ForgetPasswordController::class
)->name('forget:password');

/**
 * Forget Code Confirm
 */

 Route::post(
    uri : '/confirm',
    action : [ForgetPasswordController::class,'confirm']
)->name('forget:password');