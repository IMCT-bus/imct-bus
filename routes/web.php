<?php

use App\Http\Controllers\Admin\PassengerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\RouteController;
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

Route::group(['prefix' => 'trips', 'as' => 'trips.'], static function () {
    Route::get('/', [\App\Http\Controllers\TripController::class, 'index'])->name('index');
    Route::get('/{trip}/register', [\App\Http\Controllers\TripController::class, 'showRegister'])->name('showRegister');
    Route::post('/{trip}/register', [\App\Http\Controllers\TripController::class, 'register'])->name('register');
    Route::get('/cancel', [\App\Http\Controllers\TripController::class, 'showCancel'])->name('showCancel');
    Route::post('/{trip}/cancel', [\App\Http\Controllers\TripController::class, 'cancel'])->name('cancel');
});

Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login.index');
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
        Route::get('/logout', LogoutController::class)->name('logout');
        Route::resource('routes', RouteController::class)
            ->except('show');
        Route::resource('trips', \App\Http\Controllers\Admin\TripController::class);
        Route::resource('passengers', PassengerController::class)
            ->only('index', 'store', 'destroy');
    });
});

Route::redirect('/', '/trips');
