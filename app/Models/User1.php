<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User1 extends Model
{
    /** @use HasFactory<\Database\Factories\User1Factory> */
    use HasFactory;


    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];


    protected $hidden = [
        'password',

    ];

    

}
