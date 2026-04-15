<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User1Controller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizzController;

// ====================  login ====================
Route::prefix('cms')->group(function(){
    Route::get('{guard}/login', [UserAuthController::class, 'showLogin'])->name('view.login');
    Route::post('{guard}/login', [UserAuthController::class, 'login']);
    Route::get('logout', [UserAuthController::class, 'logout'])->name('view.logout');
});

// ====================  Student Registration (الخارجية) ====================
Route::get('cms/register', [UserAuthController::class, 'showSignup'])->name('view.register'); // عرض صفحة التسجيل
Route::post('cms/register', [StudentController::class, 'store'])->name('student.register'); // تنفيذ عملية التخزين

// ====================  الرئيسية ====================
Route::prefix('cms/home')->group(function(){
    Route::view('parent', 'cms.home.parent');
    Route::view('contact', 'cms.home.contact')->name('contact');
    Route::post('/contact/send', [ContactMessageController::class, 'store'])->name('contact.store');
    Route::get('/', [DictionaryController::class, 'home'])->name('home');

});

// ==================== AI Chat ====================
Route::post('/cms/ai/chat', [AIChatController::class, 'chat'])->name('ai.chat');

// ==================== Routes للطلاب ====================
Route::prefix('cms/student')->group(function(){
    Route::view('/', 'cms.parent');

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

    // Categories Routes
    Route::get('categories_trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::get('categories_restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::get('categories_force/{id}', [CategoryController::class, 'forceDelete'])->name('categories.force');
    Route::resource('categories', CategoryController::class);

    // Videos Routes
    Route::get('videos/player', [VideoController::class, 'player'])->name('videos.player');
    Route::resource('videos', VideoController::class);
});

// ==================== Routes للمدرسين ====================
Route::prefix('cms/instructor')->group(function(){
    Route::view('/', 'cms.parent');
    Route::put('instructors_update/{id}', [InstructorController::class, 'update'])->name('instructors_update');
    Route::resource('instructors', InstructorController::class);
    Route::resource('users', User1Controller::class);

    Route::view('temp', 'cms.temp');

    Route::get('instructors_trashed', [InstructorController::class, 'trashed'])->name('instructors_trashed');
    Route::get('instructors_restore/{id}', [InstructorController::class, 'restore'])->name('instructors_restore');
    Route::get('instructors_force/{id}', [InstructorController::class, 'force'])->name('instructors_force');
    Route::get('instructors_forceAll', [InstructorController::class, 'forceAll'])->name('instructors_forceAll');

    // Materials Routes
    Route::get('materials/trashed', [MaterialController::class, 'trashed'])->name('materials.trashed');
    Route::get('materials/{id}/restore', [MaterialController::class, 'restore'])->name('materials.restore');
    Route::get('materials/{id}/force', [MaterialController::class, 'forceDelete'])->name('materials.force');
    Route::resource('materials', App\Http\Controllers\MaterialController::class);
    Route::get('materials/trashed', [MaterialController::class, 'trashed'])->name('materials.trashed');
    Route::get('materials/{id}/restore', [MaterialController::class, 'restore'])->name('materials.restore');
    Route::get('materials/{id}/force', [MaterialController::class, 'forceDelete'])->name('materials.force');
    Route::resource('materials', MaterialController::class);

});

// ==================== Routes للكورسات ====================
Route::prefix('cms/course')->group(function(){
    Route::resource('courses', CourseController::class);
    Route::get('courses/{id}/details', [CourseController::class, 'showCourseDetails'])->name('course.details');
    Route::post('courses/{id}/enroll', [CourseController::class, 'enroll'])->name('course.enroll')->middleware('auth:student');
    Route::post('comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/course/{id}/review', [App\Http\Controllers\CourseController::class, 'storeReview'])->name('course.review.store');
    Route::resource('lessons', App\Http\Controllers\LessonController::class);
});

   


// ==================== Routes للفيديوهات ====================
Route::prefix('cms/video')->group(function(){
    Route::put('videos_update/{id}', [VideoController::class, 'update'])->name('videos_update');
    Route::resource('videos', VideoController::class);
});




// أو يمكن إضافة route منفصلة:
// Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
// Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');


// ==================== Routes للأسئلة ====================
Route::prefix('cms/question')->group(function(){
    Route::resource('questions', QuestionController::class);
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
});

// ==================== Routes للاختبارات ====================
Route::prefix('cms/quizz')->group(function(){
    Route::get('/quizzs/{quiz}/start', [QuizzController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{quiz}/submit', [QuizzController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/{quiz}/result', [QuizzController::class, 'result'])->name('quiz.result');
    Route::post('/quiz/{quiz}/save-temp', [QuizzController::class, 'saveTemp'])->name('quiz.saveTemp');
    Route::resource('quizzs', QuizzController::class);
    Route::get('/quizzs/start', [QuizzController::class, 'create'])->name('quizzs.show');
});

// ==================== صفحات أخرى ====================
Route::view('details', 'cms/courseDetails/details');
Route::view('index', 'cms/course/video/index');

