<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetFisheryArrivals extends Model
{
    protected $table = 'det_fishery_arrivals';
    protected $fillable = ['id','id_arrival','name'];
    public $timestamps = false;
}
