<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\CourseExamController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TransactionCourseController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'index'])->name('home-page');
Route::get('/courses', [FrontController::class, 'coursesPage'])->name('courses-page');
Route::get('/courses/detail/{id}', [FrontController::class, 'courseDetail'])->name('courses-detail-page');
Route::get('/articles', [FrontController::class, 'articlesPage'])->name('articles-page');
Route::get('/articles/detail/{id}', [FrontController::class, 'articleDetail'])->name('articles-detail-page');


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
    
    Route::get('/user-list', [UserListController::class, 'index'])->name('admin.user-list.index');
    Route::get('/user-role', [UserRoleController::class, 'index'])->name('admin.user-role.index');

    Route::get('/courses/{id}/moduls', [CourseMaterialController::class, 'index'])->name('admin.course-materials.index');

    Route::get('/courses/{id}/exams', [CourseExamController::class, 'index'])->name('admin.course-exam.index');

    Route::get('/courses/{id}/exams/{idExam}', [CourseExamController::class, 'show'])->name('admin.course-exam.show');

    Route::get('/courses/{id}/exams/{idExam}/execute', [CourseExamController::class, 'executeExam'])->name('admin.course-exam.execute');
    
    Route::get('/transactions', [TransactionCourseController::class, 'index'])->name('admin.transactions.index');
});

// User List
Route::post('/user-list', [UserListController::class, 'store'])->name('admin.user-list.store');
Route::get('/get-one-user', [UserListController::class, 'getOneData'])->name('admin.user-list.edit');
Route::patch('/update-user-list/{id}', [UserListController::class, 'update'])->name('admin.user-list.update');
Route::delete('/delete-user-list/{id}', [UserListController::class, 'destroy'])->name('admin.user-list.destroy');

// User Role
Route::post('/user-role', [UserRoleController::class, 'store'])->name('admin.user-role.store');
Route::get('/get-one-user-role', [UserRoleController::class, 'getOneData'])->name('admin.user-role.edit');
Route::patch('/update-user-role/{id}', [UserRoleController::class, 'update'])->name('admin.user-role.update');
Route::delete('/delete-user-role/{id}', [UserRoleController::class, 'destroy'])->name('admin.user-role.destroy');

// Courses
Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');
Route::get('/get-one-course', [CourseController::class, 'getOneData'])->name('admin.courses.edit');
Route::patch('/update-courses/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
Route::delete('/delete-courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
Route::get('/get-course-count', [CourseController::class, 'getModuleCount'])->name('admin.course-materials.count');

// Course Categories
Route::post('/course-categories', [CourseCategoryController::class, 'store'])->name('admin.course-categories.store');
Route::get('/get-one-course-category', [CourseCategoryController::class, 'getOneData'])->name('admin.course-categories.edit');
Route::patch('/update-course-categories/{id}', [CourseCategoryController::class, 'update'])->name('admin.course-categories.update');
Route::delete('/delete-course-categories/{id}', [CourseCategoryController::class, 'destroy'])->name('admin.course-categories.destroy');

// Articles
Route::post('/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
Route::get('/get-one-article', [ArticleController::class, 'getOneData'])->name('admin.articles.edit');
Route::patch('/update-articles/{id}', [ArticleController::class, 'update'])->name('admin.articles.update');
Route::delete('/delete-articles/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');

// Article Categories
Route::post('/article-categories', [ArticleCategoryController::class, 'store'])->name('admin.article-categories.store');
Route::get('/get-one-article-categories', [ArticleCategoryController::class, 'getOneData'])->name('admin.article-categories.edit');
Route::patch('/update-article-categories/{id}', [ArticleCategoryController::class, 'update'])->name('admin.article-categories.update');
Route::delete('/delete-article-categories/{id}', [ArticleCategoryController::class, 'destroy'])->name('admin.article-categories.destroy');

// Course Materials
Route::post('/course-materials', [CourseMaterialController::class, 'store'])->name('admin.course-materials.store');
Route::get('/get-one-course-materials', [CourseMaterialController::class, 'getOneData'])->name('admin.course-materials.edit');
Route::patch('/update-course-materials/{id}', [CourseMaterialController::class, 'update'])->name('admin.course-materials.update');
Route::delete('/delete-course-materials/{id}', [CourseMaterialController::class, 'destroy'])->name('admin.course-materials.destroy');

// Course Exams
Route::post('/course-exam', [CourseExamController::class, 'store'])->name('admin.course-exam.store');
Route::get('/get-one-course-exam', [CourseExamController::class, 'getOneData'])->name('admin.course-exam.edit');
Route::patch('/update-course-exam/{id}', [CourseExamController::class, 'update'])->name('admin.course-exam.update');
Route::delete('/delete-course-exam/{id}', [CourseExamController::class, 'destroy'])->name('admin.course-exam.destroy');

// Course Exam Questions
Route::post('/course-exam-question', [CourseExamController::class, 'storeQuestion'])->name('admin.course-exam-question.store');
Route::get('/get-one-course-exam-question', [CourseExamController::class, 'getOneDataQuestion'])->name('admin.course-exam-question.edit');
Route::patch('/update-course-exam-question/{id}', [CourseExamController::class, 'updateQuestion'])->name('admin.course-exam-question.update');
Route::delete('/delete-course-exam-question/{id}', [CourseExamController::class, 'destroyQuestion'])->name('admin.course-exam-question.destroy');

// Enroll Course
Route::post('/enroll-course', [TransactionCourseController::class, 'store'])->name('admin.enroll-course.store');