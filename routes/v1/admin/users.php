<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/all',
    action: AdminUserController::class
)->name('all:user');

/**
 * All Dashboard User
 */
Route::get(
    uri: '/dashboard',
    action: [DashboardController::class, 'users']
)->name('user:dashboard');
