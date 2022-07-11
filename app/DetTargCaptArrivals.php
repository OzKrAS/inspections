<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetTargCaptArrivals extends Model
{
    protected $table = 'det_targ_capt_arrivals';
    protected $fillable = ['id','id_target','nameCommon1','nameScientific1','capture1'];
    public $timestamps = false;
}
