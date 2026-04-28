<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $table = 'dictionary_entries';
    
    protected $fillable = [
        'term', 'definition', 'category', 'example'
    ];
}