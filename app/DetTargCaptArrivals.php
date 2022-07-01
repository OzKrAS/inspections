<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetTargCaptArrivals extends Model
{
    protected $table = 'det_targ_capt_arrivals';
    protected $fillable = ['id','id_arrival','capture1','nameCommon1','nameScientific1'];
    public $timestamps = false;
}
