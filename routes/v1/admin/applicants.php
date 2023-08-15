<?php

declare(strict_types=1);

use App\Http\Controllers\AdminApplicantsApplicantsUserController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/users',
    action: AdminApplicantsApplicantsUserController::class
)->name('applicants:user');

/**
 * Appliant Detail
 */

 Route::get(
    uri: '/apply/{user_id}',
    action: [AdminApplicantsApplicantsUserController::class,'applicant_detail']
)->name('applicants:user:detail');

/**
 * Appliant User Detail
 */
 Route::get(
    uri: '/apply/user/{user_id}',
    action: [AdminApplicantsApplicantsUserController::class,'applicant_user_detail']
)->name('applicants:detail');
