<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/dashboard',
    action: [DashboardController::class, 'total']
)->name('total:dashboard');

Route::get(
    uri: '/popular/jobs',
    action: [DashboardController::class, 'popular']
)->name('popular:jobs');
