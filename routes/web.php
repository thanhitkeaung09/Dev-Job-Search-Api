<?php

use App\Events\NotificationEvent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/websocket', function () {
    return view('websocket.websocket');
});



Route::get('/user/like/list', function () {
    event(new NotificationEvent("min ga lar par"));
    return "hello";
})->name('user:post:like');
