<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailDetInch extends Model
{
    protected $table = 'detail_det_inchs';
    protected $fillable = ['id','id_detinch','babor1','babor2','estribor1','estribor2','punto','tituloModal'];
    public $timestamps = false;
}
