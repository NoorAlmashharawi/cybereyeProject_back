<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    protected $fillable = [
        'text',
        'user_id',
        'lesson_id'
        ];

            // العلاقة مع الليسون
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // العلاقة مع المستخدم الذي كتب التعليق
    public function user()
    {
        return $this->belongsTo(User1::class, 'user_id');
    }

}
