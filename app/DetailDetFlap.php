<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailDetFlap extends Model
{
    protected $table = 'detail_det_flaps';
    protected $fillable = ['id','id_detflap','babor3','babor4','estribor3','estribor4','punto2','tituloModal'];
    public $timestamps = false;
}
