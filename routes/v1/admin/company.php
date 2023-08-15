<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CompanyController;
use Illuminate\Support\Facades\Route;

/**
 * Get Company List
 */
Route::get(
    uri: '/',
    action: CompanyController::class
)->name('company:list');

/**
 * Get a single company
 */
Route::get(
    uri: '/{company_id}',
    action: [CompanyController::class, 'single']
)->name('single:company');

/**
 * Delete a single company
 */
Route::delete(
    uri: '/{company_id}',
    action: [CompanyController::class, 'delete']
)->name('delete:company');

/**
 * Create a company
 */
Route::post(
    uri: '/',
    action: [CompanyController::class, 'create']
)->name('create:company');

/**
 * Update a Company
 */
Route::post(
    uri: '/update/{company_id}',
    action: [CompanyController::class, 'update']
)->name('update:company');

/**
 * Company Detail List including applicants , total jobs
 */
Route::get(
    uri: '/lists/detail',
    action: [CompanyController::class, 'company_list']
)->name('company');
