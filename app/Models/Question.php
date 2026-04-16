<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'questions';
    protected $fillable = ['quizz_id', 'title', 'type', 'options', 'correct_answer', 'points'];

    protected $casts = [
        'options' => 'array',
    ];

    public function quizz()
    {
        return $this->belongsTo(Quizz::class, 'quizz_id');
    }


public function studentAnswers()
{
    return $this->hasMany(StudentAnswer::class);
}
}
