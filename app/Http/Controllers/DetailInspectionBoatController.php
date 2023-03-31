<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailInspectionBoat;

class DetailInspectionBoatController extends Controller
{
    //
        public function dataTable(Request $request)
    {
        $detail = DetailInspectionBoat::join('flags','detail_inspection_boat.flag','=','flags.id')
        ->select( 'detail_inspection_boat.id',
        'detail_inspection_boat.id_inspection',
        'detail_inspection_boat.nameCommon1',
        'detail_inspection_boat.nameScientific1',
        'detail_inspection_boat.nameBoat',
        'detail_inspection_boat.flag',
        'detail_inspection_boat.noIdOmi',
        'detail_inspection_boat.placeTransfer',
        'detail_inspection_boat.dateTransfer',
        'detail_inspection_boat.areasCapture',
        'detail_inspection_boat.shapeProduct',
        'detail_inspection_boat.amount',
        'flags.name as flag')
        ->where('detail_inspection_boat.id_inspection', $request->id)->get();
        return ['detail' =>  $detail];   
    }
}
