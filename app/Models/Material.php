<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;

        protected $fillable = ['course_id', 'title', 'description', 'file_path', 'file_type', 'downloads_count'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}



