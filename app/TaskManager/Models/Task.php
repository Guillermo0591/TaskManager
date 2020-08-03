<?php

namespace App\TaskManager\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'users_id', 'statuses_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function statuses()
    {
        return $this->belongsTo('App\TaskManager\Models\TaskStatus');
    }
}
