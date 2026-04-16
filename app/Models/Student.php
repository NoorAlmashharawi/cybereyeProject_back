<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'enrollment_date',
        'progress',
        'level',
        'status',
        'specialization',
        'role',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];

    // ========== العلاقات ==========
    public function user1()
    {
        return $this->morphOne(User1::class, 'actor');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }


public function studentAnswers()
{
    return $this->hasMany(StudentAnswer::class, 'student_id');
}

public function quizResults()
{
    return $this->hasMany(QuizResult::class, 'student_id');
}
}
