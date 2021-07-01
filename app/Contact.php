<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // MASS ASS. 
    protected $fillable = [
        'name',
        'email', 
        'message',
    ];
}
