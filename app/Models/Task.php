<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JoydeepBhowmik\LaravelMediaLibary\Traits\HasMedia;

class Task extends Model
{
    use HasFactory, HasMedia;

    public static function boot()
    {
        parent::boot();

        static::bootHasMedia();


        static::deleting(function ($task) {
            // Delete all related conversations where model_id is the task's id
            \App\Models\Conversation::where('model_id', $task->id)->delete();
        });
    }

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
        ];
    }

    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigner_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
