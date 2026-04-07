<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory,softDeletes;


    protected $table = 'students';

    protected $fillable = [

        'enrollment_date',
        'progress',
        'level',          
        'status',          
        'specialization',  
                 
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
