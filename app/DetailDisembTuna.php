<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailDisembTuna extends Model
{
    protected $table = 'det_disemb_tuna';
    protected $fillable = ['id','id_disembTuna','poundRating','yellowFin','barrilete','patudo','other'];
    public $timestamps = false;
    //
}
