<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use JoydeepBhowmik\LaravelMediaLibary\Traits\HasMedia;

class EmployeeRelative extends Model
{

    use HasMedia;


    public static function boot()
    {
        parent::boot();

        static::bootHasMedia();
    }
}
