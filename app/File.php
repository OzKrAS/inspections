<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class file extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'name',
        'path',
        'mime_type',
        'fileable_type',
        'fileable_id'
    ];

    protected $dates = ['delete'];

}
