<?php

namespace App\Observers;

use App\Models\User1;
use App\Notifications\NewStudentRegistrationNotification;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User1 "created" event.
     */
public function created(User1 $user1): void
{
    // 1. بنجيب كل المستخدمين اللي نوعهم Admin من الداتابيز
    $admins = \App\Models\User1::where('role', 'Admin')->get();

    // 2. بنبعت الإشعار لكل أدمن فيهم
    foreach ($admins as $admin) {
        $admin->notify(new \App\Notifications\NewStudentRegistrationNotification($user1));
    }
}

    public function updated(User1 $user1): void {}
    public function deleted(User1 $user1): void {}
    public function restored(User1 $user1): void {}
    public function forceDeleted(User1 $user1): void {}
}
