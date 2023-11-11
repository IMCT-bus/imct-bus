<?php

use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Resources\RouteResource;
use App\Models\Route as ModelsRoute;
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

Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login.index');
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
        Route::get('/logout', LogoutController::class)->name('logout');
        Route::resource('routes', RouteController::class)->except('show');
        Route::resource('trips', TripController::class);
    });
    Route::redirect('/', '/admin/trips');
});

Route::get('/admin/passengers', fn() => inertia('Admin/Passengers/Index'));

// Route::redirect('/', '/trips');
