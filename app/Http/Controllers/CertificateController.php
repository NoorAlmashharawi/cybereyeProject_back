<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * عرض الشهادة في المتصفح
     */
    public function show($id)
    {
        // جلب الشهادة مع العلاقات (الطالب، الكورس، المدرب)
        $certificate = Certificate::with(['student', 'course', 'instructor'])
            ->findOrFail($id);
        
        // إرجاع العرض مع بيانات الشهادة
        return view('cms.certificates.show', compact('certificate'));
    }
}