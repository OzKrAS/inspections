<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetTargCaptArrivals;

class DetTargCaptArrivalsController extends Controller
{
    //
    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $DetTargCaptArrivals = DetTargCaptArrivals::findOrFail($request->id);
        $DetTargCaptArrivals->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
            );
        return response()->json($array,201);
    }
}
