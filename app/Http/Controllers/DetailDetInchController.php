<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailDetInch;

class DetailDetInchController extends Controller
{
    //
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = DetailDetInch::join('check_det_inches','detail_det_inchs.id_detinch','=','check_det_inches.id')    
        ->select('detail_det_inchs.id','detail_det_inchs.babor1','detail_det_inchs.babor2','detail_det_inchs.estribor1','detail_det_inchs.estribor2','detail_det_inchs.punto','detail_det_inchs.tituloModal') 
         ->where('id_detinch', $request->id)   
            ->get();

        return [     
            'checkDetFlaps' => $checkDetFlaps
        ];
    }
    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $checkDetInchs = DetailDetInch::findOrFail($request->id);
        $checkDetInchs->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro se elimino exitosamente'
            );
        return response()->json($array,201);
        
    }
}
