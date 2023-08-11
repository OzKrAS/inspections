<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetDonation extends Model
{
    protected $table = 'det_donations';
    protected $fillable = ['id','id_donation','nameScientific','nameCommon','state','presentation','amount','weight','commercialValue'];
    public $timestamps = false;

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
