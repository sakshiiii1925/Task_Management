<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'assigned_to',
        'created_by',
    ];

    // Employee assigned to this task
    public function assignedEmployee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Manager who created this task
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
