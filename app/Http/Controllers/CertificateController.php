<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * عرض شهادات الطالب (جميع الشهادات)
     */
    public function myCertificates()
    {
        $student = Auth::user()->student;
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً');
        }
        
        // جلب جميع شهادات الطالب
        $certificates = Certificate::where('student_id', $student->id)
            ->with(['course', 'instructor'])
            ->orderBy('issued_date', 'desc')
            ->get();
        
        return view('cms.certificates.my-certificates', compact('certificates', 'student'));
    }
    
    /**
     * عرض شهادة واحدة محددة
     */
    public function showCertificate($id)
    {
        $student = Auth::user()->student;
        
        $certificate = Certificate::with(['student', 'course', 'instructor'])
            ->where('id', $id)
            ->where('student_id', $student->id) // تأكد أن الشهادة تخص هذا الطالب
            ->firstOrFail();
        
        return view('cms.certificates.show', compact('certificate'));
    }


    
}