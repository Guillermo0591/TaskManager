<?php

namespace App\TaskManager\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = [
        'name', 'description'
    ];
}
