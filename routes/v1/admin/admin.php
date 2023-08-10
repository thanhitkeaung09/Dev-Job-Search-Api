<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AdminAuthChangeController;
use Illuminate\Support\Facades\Route;

/**
 * Updates User Name , Password and Image
 */

Route::post(
    uri: "/",
    action: AdminAuthChangeController::class
)->name('admin:auth:change');

/**
 * Profile
 */
Route::get(
    uri: '/',
    action: [AdminAuthChangeController::class, 'profile']
)->name('admin:profile');
