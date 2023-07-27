<?php  

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Register\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->as(':v1')->group( static function (): void {

    Route::middleware('check.app.key')->post(
        uri : '/register',
        action : [AuthController::class,'register']
        )->name('register');
});