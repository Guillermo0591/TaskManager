<?php

namespace App\TaskManager\Models;

use Illuminate\Database\Eloquent\Model;

class TagGroup extends Model
{
    protected $fillable = [
        'name', 'description',
    ];
}
