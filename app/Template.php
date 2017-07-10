<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name', 'object', 'content', 'slug'];
    protected $hidden = ['user_id'];
}
