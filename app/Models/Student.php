<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;


    protected $table = 'students';

    protected $fillable = [
        'user1_id',
        'enrollment_date',
        'progress',
        'level',
        'status',
        'specialization',
        'role',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];

    // ========== العلاقات ==========


    public function user1()
    {
        return $this->belongsTo(User1::class, 'user1_id', 'id');
    }
    public function courses()
{
    return $this->belongsToMany(Course::class, 'enrollments');
}
    // protected $fillable = [
    //     'username',
    //     'email',
    //     'role',
    //     'password',

    // ];

    // public function students(){

    // }


}
