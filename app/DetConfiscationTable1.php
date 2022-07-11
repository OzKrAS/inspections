<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetConfiscationTable1 extends Model
{
    protected $table = 'det_confiscation_table1';
    protected $fillable = ['id','id_confiscation','amount','average','commercialValue','nameCommon','nameScientific','presentation','state','weight'];
    public $timestamps = false;
}
