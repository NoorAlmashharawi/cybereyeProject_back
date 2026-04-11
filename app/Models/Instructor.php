<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User1;

use Illuminate\Database\Eloquent\softDeletes;


class Instructor extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorFactory> */
    use HasFactory,softDeletes;


   protected $fillable = [

            'specialization',
            'experience_years',
            'rating',
            'bio',
            'enrollment_date'
            ];



  protected $casts = [
        'enrollment_date' => 'date',
    ];

    // ========== العلاقات ==========

    public function user1()
    {
        return $this->morphOne(User1::class, 'actor');
    }

}
