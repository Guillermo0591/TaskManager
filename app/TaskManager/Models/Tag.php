<?php

namespace App\TaskManager\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public function tag_groups()
    {
        return $this->hasMany('App\TaskManager\Models\TagGroup');
    }
}
