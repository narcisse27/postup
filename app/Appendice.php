<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appendice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'extension', 'name' ,'filename', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id', 'template_id'
    ];
}
