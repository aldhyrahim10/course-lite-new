<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
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
    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('/article-categories', [ArticleCategoryController::class, 'index'])->name('admin.article-categories.index');
    Route::get('/user-list', [UserController::class, 'userList'])->name('admin.user-list.index');
    Route::get('/user-role', [UserController::class, 'userRole'])->name('admin.user-role.index');
});

Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');
Route::get('/get-one-course', [CourseController::class, 'getOneData'])->name('admin.courses.edit');
Route::patch('/update-courses/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
Route::delete('/delete-courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');

Route::post('/article-categories', [ArticleCategoryController::class, 'store'])->name('admin.article-categories.store');
Route::get('/get-one-article-categories', [ArticleCategoryController::class, 'getOneData'])->name('admin.article-categories.edit');
Route::patch('/update-article-categories/{id}', [ArticleCategoryController::class, 'update'])->name('admin.article-categories.update');
Route::delete('/delete-article-categories/{id}', [ArticleCategoryController::class, 'destroy'])->name('admin.article-categories.destroy');

Route::post('/course-categories', [CourseCategoryController::class, 'store'])->name('admin.course-categories.store');
Route::get('/get-one-course-category', [CourseCategoryController::class, 'getOneData'])->name('admin.course-categories.edit');
Route::patch('/update-course-categories/{id}', [CourseCategoryController::class, 'update'])->name('admin.course-categories.update');
Route::delete('/delete-course-categories/{id}', [CourseCategoryController::class, 'destroy'])->name('admin.course-categories.destroy');

Route::post('/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
Route::get('/get-one-article', [ArticleController::class, 'getOneData'])->name('admin.articles.edit');
Route::patch('/update-articles/{id}', [ArticleController::class, 'update'])->name('admin.articles.update');
Route::delete('/delete-articles/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');