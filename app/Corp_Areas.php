<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Corp_Areas extends Model
{
    use Searchable;

    public function searchableAs()
    {

        return 'corpos_areas_index';

    }
}
