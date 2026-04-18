<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Certificate;
use App\Models\User1;

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
        'user_id',
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
    return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id')
        ->withPivot('enrolled_at')
        ->withTimestamps();
}



public function studentAnswers()
{
    return $this->hasMany(StudentAnswer::class, 'student_id');
}


public function quizResults()
{
    return $this->hasMany(QuizResult::class, 'student_id');
}



public function videoProgress()
{
    return $this->hasMany(StudentVideoProgress::class);
}

public function markVideoCompleted($videoId, $courseId)
{
    $progress = StudentVideoProgress::updateOrCreate(
        [
            'student_id' => $this->id,
            'video_id' => $videoId,
        ],
        [
            'course_id' => $courseId,
            'completed' => true,
            'completed_at' => now(),
        ]
    );

    return $progress;
}

public function getCourseProgress($courseId)
{
    $totalVideos = Video::where('course_id', $courseId)->count();
    $completedVideos = StudentVideoProgress::where('student_id', $this->id)
        ->where('course_id', $courseId)
        ->where('completed', true)
        ->count();

    return [
        'total' => $totalVideos,
        'completed' => $completedVideos,
        'percentage' => $totalVideos > 0 ? round(($completedVideos / $totalVideos) * 100) : 0,
        'is_completed' => $totalVideos > 0 && $completedVideos >= $totalVideos
    ];
}

public function certificates()
{
    return $this->hasMany(Certificate::class);
}

public function hasCertificateForCourse($courseId)
{
    return $this->certificates()
        ->where('course_id', $courseId)
        ->exists();
}
}
