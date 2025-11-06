<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Company routes
    Route::resource('companies', CompanyController::class);

    // AJAX routes for location
    Route::get('api/states/{country}', [LocationController::class, 'getStates']);
    Route::get('api/cities/{state}', [LocationController::class, 'getCities']);
});

// Redirect root to companies
Route::get('/', function () {
    return redirect()->route('companies.index');
});
