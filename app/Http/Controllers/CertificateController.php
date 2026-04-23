<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment; // إذا كان عندك جدول enrollments
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    /**
     * عرض الشهادة بناءً على الكورس المسجل فيه الطالب
     */
    public function show($courseId)
    {
        $user = auth('student')->user();
        $student = $user->actor;
        $course = Course::with('instructor.user1')->findOrFail($courseId);
        
        // التحقق باستخدام العلاقة مباشرة
        $isEnrolled = $student->courses()->where('course_id', $course->id)->exists();
        
        if(!$isEnrolled) {
            abort(403, 'أنت غير مسجل في هذا الكورس. الـ student_id: ' . $student->id . ', course_id: ' . $course->id);
        }
        
        $certificate = Certificate::firstOrCreate(
            [
                'student_id' => $student->id,
                'course_id' => $course->id,
            ],
            [
                'student_name' => $student->user1->username,
                'course_name' => $course->course_name,
                'instructor_name' => $course->instructor->user1->username ?? 'إدارة المنصة',
                'certificate_number' => 'CE-' . strtoupper(uniqid()) . '-' . $student->id,
                'issue_date' => now(),
            ]
        );
        
        return view('cms.certificates.show', compact('certificate', 'student', 'course'));
    }
    /**
     * تحميل الشهادة PDF
     */
    public function download($courseId)
    {
        $student = auth('student')->user()->actor;
        $course = Course::with('instructor.user1')->findOrFail($courseId);
        
        $certificate = Certificate::where('student_id', $student->id)
                                  ->where('course_id', $course->id)
                                  ->firstOrFail();
     
        return view('cms.certificate.show', compact('certificate', 'student', 'course'));
    }

    public function myCertificates()
{
    $student = auth('student')->user()->actor;
    
    $certificates = Certificate::where('student_id', $student->id)
                               ->with('course')
                               ->latest()
                               ->paginate(10);
    
    return view('cms.certificates.my-certificates', compact('certificates'));
}
}