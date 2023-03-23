<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetConfiscationTable1;

class DetConfiscationTable1Controller extends Controller
{
    //
    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $DetDonation = DetConfiscationTable1::findOrFail($request->id);
        $DetDonation->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro se elimino exitosamente'
            );
        return response()->json($array,201);        
    }
}
