<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {

        if(auth('admin')->check()){
            return auth('admin')->user()->hasPermissionTo('index-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية عرض الأدمن');
        }


        elseif(auth('instructor')->check()){
            return auth('instructor')->user()->hasPermissionTo('index-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية عرض الأدمن');
        }


        elseif(auth('student')->check()){
            return auth('student')->user()->hasPermissionTo('index-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية عرض الأدمن');
        }


        return $this->deny('يجب تسجيل الدخول أولاً');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( )
    {

        // return $admin->hasPermissionTo('Create-Admin')
        // ? $this->allow()
        // : $this->deny("This is Cant Show Create Admin");
           if(auth('admin')->check()){
            return auth('admin')->user()->hasPermissionTo('create-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية إنشاء أدمن');
        }

        // فحص الـ instructor guard
        elseif(auth('instructor')->check()){
            return auth('instructor')->user()->hasPermissionTo(' create-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية إنشاء أدمن');
        }

        // فحص الـ student guard
        elseif(auth('student')->check()){
            return auth('student')->user()->hasPermissionTo('create-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية إنشاء أدمن');
        }

        // غير مسجل دخول
        return $this->deny('يجب تسجيل الدخول أولاً');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Admin $admin)
    {
        //

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( )
    {
          if(auth('admin')->check()){
            return auth('admin')->user()->hasPermissionTo('delete-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية حذف الأدمن');
        }

        // فحص الـ instructor guard
        elseif(auth('instructor')->check()){
            return auth('instructor')->user()->hasPermissionTo('delete-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية حذف الأدمن');
        }

        // فحص الـ student guard
        elseif(auth('student')->check()){
            return auth('student')->user()->hasPermissionTo('delete-admin')
                ? $this->allow()
                : $this->deny('لا تملك صلاحية حذف الأدمن');
        }

        // غير مسجل دخول
        return $this->deny('يجب تسجيل الدخول أولاً');

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Admin $admin)
    {
        //
    }
}


