<?php

declare(strict_types=1);

use App\Http\Controllers\AdminApplicantsApplicantsUserController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/users',
    action: AdminApplicantsApplicantsUserController::class
)->name('applicants:user');
