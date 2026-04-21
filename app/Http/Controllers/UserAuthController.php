<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{



    public function showLogin($guard){
           return  response()->view('cms.auth.login',compact('guard'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user1s,email',
            'password' => 'required',
            'guard' => 'required|in:admin,student,instructor',
        ]);
    
        $guard = $request->guard;
    
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        if (Auth::guard($guard)->attempt($credentials)) {
    
            $request->session()->regenerate();
    
            return response()->json([
                'icon' => 'success',
                'title' => 'login success',
                'redirect' => '/cms/'.$guard.'/main'
            ]);
        }
    
        return response()->json([
            'icon' => 'error',
            'title' => 'بيانات الدخول غير صحيحة'
        ], 401);
    }
    public function logout(Request  $request){
        $guard = auth('admin')->check() ? 'admin':'student';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('view.login', $guard);
    }

    public function changePassword(){

    }

    public function resetPassword(Request $request){

    }

    public function editProfile(){

    }

    public function updateProfile(Request $request, $id ){

    }

    public function showSignup()
{
    // هان بتكتبي اسم ملف الـ Blade تبع صفحة الـ Register
    // مثلاً لو الملف موجود في resources/views/cms/auth/register.blade.php
    return view('cms.auth.login');
}
}
