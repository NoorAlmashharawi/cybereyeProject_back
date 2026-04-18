<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 

class QuizResult extends Model
{
    /** @use HasFactory<\Database\Factories\QuizResultFactory> */
    use HasFactory;


    protected $table = 'quiz_results';

    protected $fillable = [
        'student_id',
        'quizz_id',
        'score',
        'total_points',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    // العلاقة مع الطالب
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id'); // أو Student::class
    }

    // العلاقة مع الكويز
    public function quizz()
    {
        return $this->belongsTo(Quizz::class);
    }
}


