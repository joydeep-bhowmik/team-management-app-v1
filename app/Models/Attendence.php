<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $casts = [
        'in_time' => 'datetime:H:i',
        'out_time' => 'datetime:H:i'
    ];


    function user()
    {

        return  $this->belongsTo(User::class);
    }
}
