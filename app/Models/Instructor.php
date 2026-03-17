<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    /** @use HasFactory<\Database\Factories\InstructorFactory> */
    use HasFactory;


   protected $fillable = [
            'user1_id',
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
        return $this->belongsTo(User1::class, 'user1_id', 'id');
    }


}
