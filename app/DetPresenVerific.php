<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetPresenVerific extends Model
{
    protected $table = 'det_presen_verifics';
    protected $fillable = ['id','id_presenVerific','element','zarpe','characterState','regFot','observation'];
    public $timestamps = false;
}
