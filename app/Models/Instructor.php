<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User1;



class Instructor extends Model
{
    use HasFactory, SoftDeletes;

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
