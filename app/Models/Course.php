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

    // علاقة الطلاب (التي أضفتيها أنتِ)
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    // علاقات إضافية (من كود براء)
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
