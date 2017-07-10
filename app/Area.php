<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Area extends Model
{
    use Searchable;

    public function searchableAs()
    {

        return 'areas_index';

    }
}
