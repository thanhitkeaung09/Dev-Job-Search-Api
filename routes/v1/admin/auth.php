<?php

declare(strict_types=1);

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::post(
    uri: '/',
    action: AdminController::class
)->name('admin:login');

/**
 * Logout
 */
Route::middleware('auth:admin')->post(
    uri: '/logout',
    action: [AdminController::class, 'logout']
)->name('logout:admin');

/**
 * Test
 */
Route::middleware('auth:admin')->post(
    uri: '/test',
    action: [AdminController::class, 'test']
)->name('test:admin');

/**
 * Job Admin Route
 */
Route::prefix('job')->as(':job')->middleware('auth:admin')->group(
    base_path('/routes/v1/admin/job.php')
);

/**
 * CV Admin Route
 */
Route::prefix('cv')->as(':cv')->middleware('auth:admin')->group(
    base_path('/routes/v1/admin/cv.php')
);
/**
 * Change Admin Name , Password , Image
 */
Route::prefix('auth')->as(':auth')->middleware('auth:admin')->group(
    base_path('/routes/v1/admin/admin.php')
);

/**\
 * Company Create , Retrieve , Update , Delete
 */
Route::prefix('company')->as(':company')->middleware('auth:admin')->group(
    base_path('/routes/v1/admin/company.php')
);

Route::prefix('applicants')->as(':applicants')->middleware('auth:admin')->group(
    base_path('/routes/v1/admin/applicants.php')
);

Route::prefix('users')->as(':users')->middleware('auth:admin')->group(
    base_path('/routes/v1/admin/users.php')
);

Route::prefix('total')->as(':total')->middleware('auth:admin')->group(
    base_path('/routes/v1/admin/total.php')
);
