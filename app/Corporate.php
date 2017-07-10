<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Corporate extends Model
{

    use Searchable;

    public function searchableAs()
    {

        return 'corporates_index';

    }
}
