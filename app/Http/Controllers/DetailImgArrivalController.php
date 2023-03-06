<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailImgArrival;

class DetailImgArrivalController extends Controller
{
    //
public function getImg(Request $request)
    {
        $images = DetailImgArrival::select('id','path','id_arrival')
            ->orderBy('id', 'asc')
            ->where('id_arrival','=',$request->idArrival)
            ->get();
        return [
            'images' => $images
        ];
    } 
}
