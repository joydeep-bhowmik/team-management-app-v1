<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Epr extends Model
{
    protected $casts = [
        'month' => 'datetime',
    ];
}
