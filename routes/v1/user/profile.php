<?php

declare(strict_types=1);

use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/',
    action: ProfileController::class
)->name('profile:get');
