<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFisherAutDetFl extends Model
{
    protected $table = 'detail_fisher_aut_det_flaps';
    protected $fillable = ['id','id_fisheryAut','name'];
    public $timestamps = false;
    //
}
