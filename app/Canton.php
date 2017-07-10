<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Canton extends Model
{
    use Searchable;


    public function searchableAs()
    {

        return 'cantons_index';

    }
}
