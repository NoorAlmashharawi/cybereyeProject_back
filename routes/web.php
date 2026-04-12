<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User1Controller;
use App\http\Controllers\StudentController;
use App\http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\VideoController;
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('cms/student')->group(function(){
    Route::view('/', 'cms.parent');
<<<<<<< Updated upstream
Route::view('temp', 'cms.temp');

Route::put('students_update/{id}', [StudentController::class, 'update'])->name('students_update');
Route::resource('students', StudentController::class);
Route::resource('users', User1sController::class);

=======
    Route::view('temp', 'cms.temp');

    Route::put('students_update/{id}', [StudentController::class, 'update'])->name('students_update');
    Route::get('students_trashed', [StudentController::class, 'trashed'])->name('students_trashed');
    Route::get('students_restore/{id}', [StudentController::class, 'restore'])->name('students_restore');
    Route::get('students_force/{id}', [StudentController::class, 'force'])->name('students_force');
    Route::get('students_forceAll', [StudentController::class, 'forceAll'])->name('students_forceAll');

    Route::resource('students', StudentController::class);
    Route::resource('users', User1Controller::class);
>>>>>>> Stashed changes
});
Route::prefix('cms/instructor')->group(function(){
Route::view('/', 'cms.parent');
Route::view('temp', 'cms.temp');

Route::put('instructors_update/{id}', [InstructorController::class, 'update'])->name('instructors_update');
Route::resource('instructors', InstructorController::class);
Route::resource('users', User1sController::class);

<<<<<<< Updated upstream
=======
    Route::get('instructors_trashed', [InstructorController::class, 'trashed'])->name('instructors_trashed');
    Route::get('instructors_restore/{id}', [InstructorController::class, 'restore'])->name('instructors_restore');
    Route::get('instructors_force/{id}', [InstructorController::class, 'force'])->name('instructors_force');
    Route::get('instructors_forceAll', [InstructorController::class, 'forceAll'])->name('instructors_forceAll');

>>>>>>> Stashed changes
});



<<<<<<< Updated upstream

=======
    Route::view('details','cms/courseDetails/details')
    ;


    Route::prefix('cms/video')->group(function(){

    Route::put('videos_update/{id}', [VideoController::class, 'update'])->name('videos_update');
    Route::resource('videos', VideoController::class);


});


/////////////////////////


Route::resource('questions', QuestionController::class)->only(['create', 'store']);
// أو يمكن إضافة route منفصلة:
// Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
// Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

  Route::prefix('cms/question')->group(function(){
    Route::resource('questions', QuestionController::class);
     Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
 Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');



});


///////////////////////////////
  Route::prefix('cms/quizz')->group(function(){



Route::get('/quizzs/{quiz}/start', [QuizzController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{quiz}/submit', [QuizzController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/{quiz}/result', [QuizzController::class, 'result'])->name('quiz.result');
Route::post('/quiz/{quiz}/save-temp', [QuizzController::class, 'saveTemp'])->name('quiz.saveTemp');

    Route::resource('quizzs', QuizzController::class);
     Route::get('/quizzs/start', [QuizzController::class, 'create'])->name('quizzs.show');



});
 
>>>>>>> Stashed changes
