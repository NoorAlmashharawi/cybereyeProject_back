<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User1sController;
use App\http\Controllers\StudentController;
use App\http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseControllerController;
Route::get('/', function () {
    return view('welcome');
});


Route::prefix('cms/student')->group(function(){
    Route::view('/', 'cms.parent');
Route::view('temp', 'cms.temp');
Route::put('students_update/{id}', [StudentController::class, 'update'])->name('students_update');
Route::resource('students', StudentController::class);
Route::resource('users', User1sController::class);


});

Route::prefix('cms/instructor')->group(function(){
Route::view('/', 'cms.parent');
Route::view('temp', 'cms.temp');
Route::put('instructors_update/{id}', [InstructorController::class, 'update'])->name('instructors_update');
Route::resource('instructors', InstructorController::class);
Route::resource('users', User1sController::class);

});



Route::prefix('cms/course')->group(function(){
// Route::view('/', 'cms.parent');
// Route::view('temp', 'cms.temp');

// Route::put('instructors_update/{id}', [InstructorController::class, 'update'])->name('courses_update');
Route::resource('courses', CourseController::class);
// Route::resource('users', User1sController::class);

});


