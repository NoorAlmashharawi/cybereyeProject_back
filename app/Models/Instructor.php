<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

=======
use App\Models\User1;

use Illuminate\Database\Eloquent\softDeletes;


>>>>>>> fb9c55c067aa10cfad48f088973bb8efdfefd44f
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

<<<<<<< HEAD
    protected $casts = [
=======
   protected $fillable = [

            'specialization',
            'experience_years',
            'rating',
            'bio',
            'enrollment_date'
            ];



  protected $casts = [
>>>>>>> fb9c55c067aa10cfad48f088973bb8efdfefd44f
        'enrollment_date' => 'date',
    ];

    // ========== العلاقات ==========
    public function user1()
    {
        return $this->morphOne(User1::class, 'actor');
    }
}