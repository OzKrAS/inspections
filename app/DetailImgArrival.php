<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailImgArrival extends Model
{
    //
    protected $table = 'detail_img_arrival';
    protected $fillable = ['id','path','id_arrival'];
    public $timestamps = false;
}
