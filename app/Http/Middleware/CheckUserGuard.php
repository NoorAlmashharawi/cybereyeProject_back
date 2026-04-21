<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserGuard
{
    public function handle(Request $request, Closure $next, $guard)
    {
        // التحقق من أن المستخدم مسجل دخول بنفس الـ guard المطلوب
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('view.login', ['guard' => $guard]);
        }
        
        // التحقق من تطابق الـ guard المخزن في الجلسة
        if (session('user_guard') !== $guard) {
            Auth::logout();
            session()->flush();
            return redirect()->route('view.login', ['guard' => $guard])
                ->with('error', 'تم تسجيل الخروج تلقائياً بسبب عدم تطابق البيانات');
        }
        
        return $next($request);
    }
}