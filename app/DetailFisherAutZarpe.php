<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFisherAutZarpe extends Model
{
    protected $table = 'detail_fisher_aut_zarpes';
    protected $fillable = ['id','id_fisheryAut','name'];
    public $timestamps = false;
}
