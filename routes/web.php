<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\SlackController;
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

Route::get('/', function () {
    return view('app');
})->name('welcome');

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::post('/store', 'store')->name('store');
});

Route::controller(SlackController::class)->group(function () {
    Route::get('/messages', 'viewMessages')->name('messages');
    Route::post('/modify', 'modify')->name('modify');
    Route::post('/notify', 'notify')->name('notify');

});
