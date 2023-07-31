<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CV\CVController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/',
    action: CVController::class
)->name('get:cvs');
