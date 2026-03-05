<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\User1Controller;
use App\http\Controllers\StudentController;
use App\http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});


Route::prefix('cms/student')->group(function(){
    Route::view('/', 'cms.parent');
Route::view('temp', 'cms.temp');

Route::put('students_update/{id}', [StudentController::class, 'update'])->name('students_update');
Route::resource('students', StudentController::class);




});


