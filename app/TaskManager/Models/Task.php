<?php

namespace App\TaskManager\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
