<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name', 'category_id', 'instructor_id',
        'short_description', 'level', 'no_hours',
        'status', 'course_image', 'rating'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function instructor() {
        // إذا كان مودل المدرب اسمه Instructor
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
    public function students()
{
    return $this->belongsToMany(Student::class, 'enrollments');
}
}
