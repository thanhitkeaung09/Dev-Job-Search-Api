<?php 

declare(strict_types=1);

use App\Http\Controllers\Job\JobController;
use Illuminate\Support\Facades\Route;

Route::post(
    uri : '/',
    action : [JobController::class,'search_jobs']
)->name('job');

Route::get(
    uri : '/',
    action : [JobController::class,'show_jobs']
)->name('job');

Route::get(
    uri : '/{job_id}',
    action : [JobController::class,'single_job']
)->name('job');