<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User1Controller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;

// ==================== الصفحة الرئيسية ====================

Route::prefix('cms/home')->group(function(){
    Route::view('parent', 'cms.home.parent');
    Route::get('/', [DictionaryController::class, 'home'])->name('home');
});



// ==================== AI Chat ====================
Route::post('/cms/ai/chat', [AIChatController::class, 'chat'])->name('ai.chat');




// ==================== Routes للطلاب ====================
Route::prefix('cms/student')->group(function(){
    Route::view('/', 'cms.parent');
    Route::view('temp', 'cms.temp');
    Route::put('students_update/{id}', [StudentController::class, 'update'])->name('students_update');

    Route::resource('students', StudentController::class);
    Route::resource('users', User1Controller::class);
});

// ==================== Routes admin ====================
Route::prefix('cms/admin')->group(function(){

    Route::get('main', [AdminController::class, 'index'])->name('main');
    // Route::get('main', [AdminController::class, 'dashboard'])->name('main');

});



// ==================== Routes للمدرسين ====================
Route::prefix('cms/instructor')->group(function(){
    Route::view('/', 'cms.parent');
    Route::put('instructors_update/{id}', [InstructorController::class, 'update'])->name('instructors_update');
    Route::resource('instructors', InstructorController::class);
    Route::resource('users', User1Controller::class);
});



    // Route::view('details','cms/courseDetails/details')
    // ;

    Route::prefix('courses')->group(function () {
    // صفحة تفاصيل الكورس
    Route::get('{id}', [CourseController::class, 'show'])->name('course.details');

    // تسجيل في الكورس
    // Route::post('{id}/enroll', [CourseController::class, 'enroll'])->name('course.enroll');

    // // إضافة تقييم
    // Route::post('{id}/review', [CourseController::class, 'addReview'])->name('course.review');

    // // تحميل مادة
    // Route::get('material/{id}/download', [CourseController::class, 'downloadMaterial'])->name('course.download');

    // // إضافة للمفضلة
    // Route::post('{id}/favorite', [CourseController::class, 'addToFavorites'])->name('course.favorite');
});
