<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Job\JobController;
use Illuminate\Support\Facades\Route;

/**
 * Job Post
 */
Route::post(
    uri: '/',
    action: JobController::class
)->name('job:create');

/**
 * Single Job Get
 */
Route::get(
    uri: '/{job_id}',
    action: [JobController::class, 'single']
)->name('job:get:single');

/**
 * Get Jobs
 */
Route::get(
    uri: '/',
    action: [JobController::class, 'all']
)->name('job:get:all');

/**
 * Delete a Job
 */
Route::delete(
    uri: "/{job_id}",
    action: [JobController::class, 'delete']
)->name('job:delete');

/**
 * Update a job
 */
Route::post(
    uri: '/update/{job_id}',
    action: [JobController::class, 'update']
)->name('job:update');
