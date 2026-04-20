<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;
use App\Models\Admin;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Course;
use App\Models\Lesson;
use App\Policies\CoursePolicy;
use App\Policies\LessonPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * تسجيل الـ Policies
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
        Lesson::class => LessonPolicy::class,
    ];

    public function boot()
    {
        // تسجيل مقدمي المصادقة (Authentication Providers)
        Auth::provider('admins', function ($app, array $config) {
            return new EloquentUserProvider($app['hash'], Admin::class);
        });
        
        Auth::provider('instructors', function ($app, array $config) {
            return new EloquentUserProvider($app['hash'], Instructor::class);
        });
        
        Auth::provider('students', function ($app, array $config) {
            return new EloquentUserProvider($app['hash'], Student::class);
        });

        // تسجيل الـ Policies
        $this->registerPolicies();
    }
}