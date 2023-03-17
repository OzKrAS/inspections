<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetFaunaCaptArrivals;

class DetFaunaCaptArrivalsController extends Controller
{
    //
public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $DetFaunaCaptArrivals = DetFaunaCaptArrivals::findOrFail($request->id);
        $DetFaunaCaptArrivals->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
            );
        return response()->json($array,201);
    }
}
