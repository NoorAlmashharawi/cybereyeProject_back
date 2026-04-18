<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        // السطر هاد هو اللي بيربط الموديل بالأوبسيرفر
    \App\Models\User1::observe(\App\Observers\UserObserver::class);
    }
}
