<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Admin;
use App\Models\Instructor;
use App\Models\Student;



class AuthServiceProvider extends ServiceProvider
{

public function boot()
{
    Auth::provider('admins', function ($app, array $config) {
        return new EloquentUserProvider($app['hash'], Admin::class);
    });
    
    Auth::provider('instructors', function ($app, array $config) {
        return new EloquentUserProvider($app['hash'], Instructor::class);
    });
    
    Auth::provider('students', function ($app, array $config) {
        return new EloquentUserProvider($app['hash'], Student::class);
    });



    
}
}






