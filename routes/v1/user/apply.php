<?php 

declare(strict_types=1);

use App\Http\Controllers\JobApplyController;
use Illuminate\Support\Facades\Route;

Route::post(
    uri : '/',
    action : JobApplyController::class
)->name('apply');

Route::get(
    uri : '/',
    action : [JobApplyController::class,'get']
)->name('apply');