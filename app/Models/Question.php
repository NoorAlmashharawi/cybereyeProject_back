<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

       protected $fillable = [

        'title',
        'type',
        'options',
        'correct_answer',
        'points',
        'quizz_id'
              ];
    protected $casts = [
        'options' => 'array',
    ];


    public function quizz() {
        return $this->belongsTo(Quizz::class);
    }


    public function getFormattedOptionsAttribute() {
        if ($this->type === 'tf') return ['True', 'False'];
        return $this->options ?? [];
    }

}
