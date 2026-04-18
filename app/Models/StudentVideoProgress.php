<?php
// app/Models/StudentVideoProgress.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentVideoProgress extends Model
{
    protected $table = 'student_video_progress';
    
    protected $fillable = [
        'student_id',
        'video_id',
        'course_id',
        'completed',
        'last_position',
        'completed_at'
    ];
    
    protected $casts = [
        'completed' => 'boolean',
        'completed_at' => 'datetime'
    ];



    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}