<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDesignation extends Model
{
    use HasFactory;

    public function assignableDesignations()
    {
        return $this->belongsToMany(UserDesignation::class, 'task_permissions', 'assigner_designation_id', 'assignee_designation_id');
    }
}
