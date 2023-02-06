<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailInspectionBoat extends Model
{
    //
    protected $table = 'detail_inspection_boat';
   protected $fillable = [
        'id',
        'id_inspection',
        'nameCommon1',
        'nameScientific1',
        'nameBoat',
        'flag',
        'noIdOmi',
        'placeTransfer',
        'dateTransfer',
        'areasCapture',
        'shapeProduct',
        'amount',
    ];
    public $timestamps = false;
}
