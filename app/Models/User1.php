<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User1 as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User1 extends Model
{
    /** @use HasFactory<\Database\Factories\User1Factory> */


    use HasFactory, Notifiable;

    protected $table = 'user1s';

    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // ========== العلاقات ==========

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

      public function instructor()
    {
        return $this->hasOne(Instructor::class, 'user1_id', 'id');
    }


}
