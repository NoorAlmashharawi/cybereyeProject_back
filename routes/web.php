<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User1Controller;
use App\http\Controllers\StudentController;
use App\http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('cms/student')->group(function(){
    Route::view('/', 'cms.parent');
Route::view('temp', 'cms.temp');
// Route::view('main', 'cms.student.main')->name('main');;

Route::put('students_update/{id}', [StudentController::class, 'update'])->name('students_update');
Route::get('main', [StudentController::class, 'dashboard'])->name('main');

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




