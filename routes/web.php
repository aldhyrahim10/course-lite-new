<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
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

Route::middleware('auth')->prefix('admin')->group(function () {
    // Admin Route
    Route::get('/', function () {
        return view('pages.home');
    })->name('admin.dashboard');

    Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/course-categories', [CourseCategoryController::class, 'index'])->name('admin.course-categories.index');

    Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/get-one-course', [CourseController::class, 'getOneData'])->name('admin.courses.edit');
    Route::patch('/update-courses/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/delete-courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
});



Route::post('/course-categories', [CourseCategoryController::class, 'store'])->name('admin.course-categories.store');
Route::get('/get-one-course-category', [CourseCategoryController::class, 'getOneData'])->name('admin.course-categories.edit');
Route::patch('/update-course-categories/{id}', [CourseCategoryController::class, 'update'])->name('admin.course-categories.update');
Route::delete('/delete-course-categories/{id}', [CourseCategoryController::class, 'destroy'])->name('admin.course-categories.destroy');