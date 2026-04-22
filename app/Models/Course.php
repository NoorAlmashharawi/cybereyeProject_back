<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'category_id',
        'instructor_id',
        'short_description',
        'level',
        'no_hours',
        'status',
        'course_image',
        'rating',
        'student_id'
    ];

    // علاقة التصنيف
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // علاقة المدرب (واحدة فقط تكفي)
    public function instructor() {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }




    // العلاقات


    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
public function videos() {
    return $this->hasMany(Video::class);
}
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments','course_id', 'student_id') ->withPivot('enrolled_at')
        ->withTimestamps();
    }


    public function comments()
    {
    return $this->hasManyThrough(Comment::class, Lesson::class);
    }

}
