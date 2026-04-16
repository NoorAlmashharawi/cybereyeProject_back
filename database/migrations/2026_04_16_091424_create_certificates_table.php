<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function __construct()
    {
        // تعديل middleware auth ليشمل guard افتراضي
        $this->middleware('auth:web');
    }

    // عرض الشهادة
    public function show($id)
    {
        // تأكد من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('view.login', ['guard' => 'student']);
        }
        
        $certificate = Certificate::with(['student', 'course', 'instructor'])
            ->findOrFail($id);
        
        // تأكد أن المستخدم الحالي هو صاحب الشهادة
        if ($certificate->student_id != Auth::user()->actor_id) {
            abort(403, 'هذه الشهادة لا تخصك');
        }
        
        return view('cms.certificates.show', compact('certificate'));
    }

    // تحميل PDF
    public function download($id)
    {
        // تأكد من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('view.login', ['guard' => 'student']);
        }
        
        $certificate = Certificate::with(['student', 'course', 'instructor'])
            ->findOrFail($id);
        
        if ($certificate->student_id != Auth::user()->actor_id) {
            abort(403);
        }
        
        $data = [
            'certificate' => $certificate,
            'student' => $certificate->student,
            'course' => $certificate->course,
            'instructor' => $certificate->instructor,
            'platform' => 'Cyber Eye',
            'date' => $certificate->issued_date->format('Y-m-d'),
        ];
        
        $pdf = Pdf::loadView('cms.certificates.pdf', $data);
        $pdf->setPaper('a4', 'landscape');
        
        return $pdf->download('certificate-' . $certificate->certificate_number . '.pdf');
    }
}