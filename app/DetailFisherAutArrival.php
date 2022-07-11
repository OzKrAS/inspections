<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFisherAutArrival extends Model
{
    protected $table = 'detail_fisher_aut_arrivals';
    protected $fillable = ['id','id_fisheryAut','name'];
    public $timestamps = false;
}
