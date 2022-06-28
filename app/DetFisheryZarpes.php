<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetFisheryZarpes extends Model
{
    protected $table = 'det_fishery_zarpes';
    protected $fillable = ['id','id_zarpe','name'];
    public $timestamps = false;
}
