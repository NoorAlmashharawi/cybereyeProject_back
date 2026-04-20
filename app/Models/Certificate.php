<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'instructor_id',
        'certificate_number',
        'issued_date',
    ];

    protected $casts = [
        'issued_date' => 'date',
    ];

    // ========== العلاقات ==========
    
    public function student()
    {
        return $this->belongsTo(User1::class, 'student_id');
    }

    // علاقة الشهادة مع الكورس
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // علاقة الشهادة مع المدرب
    public function instructor()
    {
        return $this->belongsTo(User1::class, 'instructor_id');
    }
}