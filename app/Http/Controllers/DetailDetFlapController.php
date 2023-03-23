<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailDetFlap; 

class DetailDetFlapController extends Controller
{
    //
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = DetailDetFlap::join('check_det_flaps','detail_det_flaps.id_detflap','=','check_det_flaps.id')    
        ->select('detail_det_flaps.id','detail_det_flaps.babor3','detail_det_flaps.babor4','detail_det_flaps.estribor3','detail_det_flaps.estribor4','detail_det_flaps.punto2','detail_det_flaps.tituloModal') 
         ->where('id_detflap', $request->id)   
            ->get();

        return [     
            'checkDetFlaps' => $checkDetFlaps
        ];
    }
    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $checkDetInchs = DetailDetFlap::findOrFail($request->id);
        $checkDetInchs->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro se elimino exitosamente'
            );
        return response()->json($array,201);
        
    }
}
