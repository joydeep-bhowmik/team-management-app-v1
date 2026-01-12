<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendenceRequest extends Model
{

    protected $casts = [
        'time' => 'datetime:H:i',
    ];

    function user()
    {

        return  $this->belongsTo(User::class);
    }
}
