<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetConfiscationTable2 extends Model
{
    protected $table = 'det_confiscation_table2';
    protected $fillable = ['id','id_confiscation','amount2','characterState','commercialValue2','element'];
    public $timestamps = false;
}
