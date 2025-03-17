<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('dashboard');


Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    // Admin Route
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('pages.home');
        })->name('admin.dashboard');
    });
});