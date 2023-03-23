<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetDonation;

class DetDonationsController extends Controller
{
    //
    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $DetDonation = DetDonation::findOrFail($request->id);
        $DetDonation->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro se elimino exitosamente'
            );
        return response()->json($array,201);        
    }
}
