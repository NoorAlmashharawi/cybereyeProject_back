<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;
    use SoftDeletes;

       protected $fillable = [
        'title',
        'file_path',
        'file_type',
        'course_id',
        'description',
        'downloads_count'
        ];

        public function course() {
            return $this->belongsTo(Course::class);
        }


public function videos() {
    return $this->hasMany(Video::class);
}
}



