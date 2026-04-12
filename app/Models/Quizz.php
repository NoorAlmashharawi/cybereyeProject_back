<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    /** @use HasFactory<\Database\Factories\QuizzFactory> */
    use HasFactory;
     protected $table = 'quizzs';
    protected $fillable = ['title', 'description', 'duration_minutes', 'total_marks', 'course_id'];

    public function questions() {
        return $this->hasMany(Question::class, 'quizz_id');
    }

    //public function attempts() {
      //  return $this->hasMany(QuizAttempt::class, 'quizz_id');
    //}

    public function course() {
        return $this->belongsTo(Course::class); // إذا كان لديك جدول courses
    }
}
