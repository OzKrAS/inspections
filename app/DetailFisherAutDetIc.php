<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFisherAutDetIc extends Model
{
    protected $table = 'detail_fisher_aut_det_inchs';
    protected $fillable = ['id','id_fisheryAut','name'];
    public $timestamps = false;
    //
}
