<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;

   protected $fillable = [
        'lesson_id',
        'title',
        'description',
        'video_url',
        'duration',
        'order'
    ];

    // العلاقة مع الدرس
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

}
