<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetCaptFaunaArrivals extends Model
{
    protected $table = 'det_capt_fauna_arrivals';
    protected $fillable = ['id','id_arrival','capture2','nameCommon2','nameScientific2'];
    public $timestamps = false;
}
