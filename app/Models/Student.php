<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'enrollment_date',
        'progress',
<<<<<<< HEAD
=======

>>>>>>> fb9c55c067aa10cfad48f088973bb8efdfefd44f
        'level',
        'status',
        'specialization',
        'role',
<<<<<<< HEAD
        'user_id',
=======



>>>>>>> fb9c55c067aa10cfad48f088973bb8efdfefd44f
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];

    // ========== العلاقات ==========
<<<<<<< HEAD
=======




>>>>>>> fb9c55c067aa10cfad48f088973bb8efdfefd44f
    public function user1()
    {
        return $this->morphOne(User1::class, 'actor');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
<<<<<<< HEAD


public function studentAnswers()
{
    return $this->hasMany(StudentAnswer::class, 'student_id');
}
<<<<<<< HEAD
=======
    // protected $fillable = [
    //     'username',
    //     'email',
    //     'role',
    //     'password',

    // ];

    // public function students(){

    // }


>>>>>>> fb9c55c067aa10cfad48f088973bb8efdfefd44f

public function quizResults()
{
    return $this->hasMany(QuizResult::class, 'student_id');
=======
    
    public function user() {
    return $this->hasOne(User1::class, 'actor_id', 'id')->where('actor_type', Student::class);
>>>>>>> 0485254d335552e545ec0d632fe5eeaf8df1698a
}
}
