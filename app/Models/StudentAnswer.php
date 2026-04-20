<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\StudentAnswerFactory> */
    use HasFactory;


    protected $table = 'student_answers';

    protected $fillable = [
        'student_id',
        'quizz_id',
        'question_id',
        'answer',
        'is_correct',
        'points_earned',
        'submitted_at',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'submitted_at' => 'datetime',
    ];

    // العلاقات
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');  
    }

    public function quizz()
    {
        return $this->belongsTo(Quizz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
