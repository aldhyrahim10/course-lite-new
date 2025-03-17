<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('dashboard');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {
    // Admin Route
    Route::middleware('can:administrator')->prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('pages.admin.dashboard');
        })->name('admin.dashboard');
    });

    // Instructor Route
    Route::middleware('can:instructor')->prefix('instructor')->group(function () {
        Route::get('/', function () {
            return view('pages.instructor.dashboard');
        })->name('instructor.dashboard');
    });

    // Student Route
    Route::middleware('can:student')->prefix('student')->group(function () {
        Route::get('/', function () {
            return view('pages.student.dashboard');
        })->name('student.dashboard');
    });
});