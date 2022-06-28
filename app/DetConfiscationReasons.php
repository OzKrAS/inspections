<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetConfiscationReasons extends Model
{
    //
    protected $table = 'det_confiscation_reasons';
    protected $fillable = ['id','id_confiscation','name'];
    public $timestamps = false;
}
