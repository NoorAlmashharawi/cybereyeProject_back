<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    /**
     * عرض الشهادة في المتصفح
     */

    public function show($id)
    {
        $certificate = Certificate::with(['student', 'course', 'instructor'])
            ->findOrFail($id);
        
        return view('cms.certificates.show', compact('certificate'));
    }

    /**
     * منح الشهادة فوراً (دون شروط)
     */
    public function requestNow(Request $request)
    {
        $student = Auth::user()->student;
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'يجب أن تكون مسجلاً كطالب أولاً'
            ], 403);
        }

        $courseId = $request->course_id;
        $course = Course::find($courseId);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'الكورس غير موجود'
            ], 404);
        }

        // منح الشهادة (أو إرجاع الموجودة)
        $certificate = Certificate::firstOrCreate(
            [
                'student_id' => $student->id,
                'course_id' => $courseId,
            ],
            [
                'instructor_id' => $course->instructor_id ?? 1,
                'certificate_number' => 'CERT-' . strtoupper(Str::random(10)) . '-' . $student->id,
                'issued_date' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'certificate_id' => $certificate->id,
            'certificate_url' => route('certificate.show', $certificate->id),
        ]);
    }
}
