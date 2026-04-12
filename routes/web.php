<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User1Controller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserAuthController;

// ====================  login ====================
Route::prefix('cms')->group(function(){
    Route::get('{guard}/login', [UserAuthController::class, 'showLogin'])->name('view.login');
    Route::post('{guard}/login', [UserAuthController::class, 'login']);
    Route::get('logout', [UserAuthController::class, 'logout'])->name('view.logout');
});

// ====================  الرئيسية ====================
Route::prefix('cms/home')->group(function(){
    Route::view('parent', 'cms.home.parent');
    Route::view('contact', 'cms.home.contact')->name('contact');
    Route::get('/', [DictionaryController::class, 'home'])->name('home');
});

// ==================== AI Chat ====================
Route::post('/cms/ai/chat', [AIChatController::class, 'chat'])->name('ai.chat');

// ==================== Routes للطلاب ====================
Route::prefix('cms/student')->group(function(){
    Route::view('/', 'cms.parent');
    Route::view('temp', 'cms.temp');
    
    Route::put('students_update/{id}', [StudentController::class, 'update'])->name('students_update');
    Route::get('students_trashed', [StudentController::class, 'trashed'])->name('students_trashed');
    Route::get('students_restore/{id}', [StudentController::class, 'restore'])->name('students_restore');
    Route::get('students_force/{id}', [StudentController::class, 'force'])->name('students_force');
    Route::get('students_forceAll', [StudentController::class, 'forceAll'])->name('students_forceAll');
    
    Route::resource('students', StudentController::class);
    Route::resource('users', User1Controller::class);
});

// ==================== Routes admin ====================
Route::prefix('cms/admin')->group(function(){
    Route::get('main', [AdminController::class, 'main'])->name('main');
    Route::resource('admins', AdminController::class);
});

// ==================== Routes للمدرسين ====================
Route::prefix('cms/instructor')->group(function(){
    Route::view('/', 'cms.parent');
    Route::put('instructors_update/{id}', [InstructorController::class, 'update'])->name('instructors_update');
    Route::resource('instructors', InstructorController::class);
    Route::resource('users', User1Controller::class);
    
    Route::get('instructors_trashed', [InstructorController::class, 'trashed'])->name('instructors_trashed');
    Route::get('instructors_restore/{id}', [InstructorController::class, 'restore'])->name('instructors_restore');
    Route::get('instructors_force/{id}', [InstructorController::class, 'force'])->name('instructors_force');
    Route::get('instructors_forceAll', [InstructorController::class, 'forceAll'])->name('instructors_forceAll');
});

// ==================== Routes للكورسات ====================
Route::prefix('cms/course')->group(function(){
    Route::resource('courses', CourseController::class);
});