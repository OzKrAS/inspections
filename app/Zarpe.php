<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zarpe extends Model
{
    public function file()
    {
        return $this->morphTo('App\File', 'fileable');
    }
}
