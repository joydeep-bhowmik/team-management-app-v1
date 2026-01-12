<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use JoydeepBhowmik\LaravelMediaLibary\Traits\HasMedia;

class Conversation extends Model
{
    use HasMedia;

    public static function boot()
    {
        parent::boot();

        static::bootHasMedia();
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
