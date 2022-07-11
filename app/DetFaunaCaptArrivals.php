<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetFaunaCaptArrivals extends Model
{
    protected $table = 'det_fauna_capt_arrivals';
    protected $fillable = ['id','id_fauna','nameCommon2','nameScientific2','capture2'];
    public $timestamps = false;
}
