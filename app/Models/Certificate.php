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
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}