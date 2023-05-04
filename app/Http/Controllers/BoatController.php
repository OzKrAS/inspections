<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boat;
use App\Flag;

class BoatController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $boats = Boat::join('flags','boats.id_flag','=','flags.id')
            ->join('companies','boats.id_company','=','companies.id')
            ->select('boats.id',
                     'boats.nameBoat',
                     'boats.enrollment',
                     'boats.noPatent',
                     'boats.noResolution',
                     'boats.nameRepresent',
                     'boats.dateValidityPat',
                     'boats.dateValid',
                     'boats.dateResolution',
                     'boats.id_company',
                     'companies.name as nameCompany',
                     'boats.is_dets',
                     'boats.id_flag','flags.name as nameFlag',
            )

            ->paginate(99999);

        return [
            'data' => $boats
        ];
    }
    public function selectBoats(Request $request)
    {
     //   if (!$request->ajax()) return redirect('/');

        $type = $request->type;
        $boats = Boat::join('flags','boats.id_flag','=','flags.id')
        ->join('companies','boats.id_company','=','companies.id')
        ->select('boats.id',
                    'boats.nameBoat',
                    'boats.enrollment',
                    'boats.noPatent',
                    'boats.noResolution',
                    'boats.nameRepresent',
                    'boats.dateValidityPat',
                    'boats.dateValid',
                    'boats.dateResolution',
                    'boats.id_company',
                    'companies.name as nameCompany',
                    'boats.is_dets',
                    'boats.id_flag','flags.name as nameFlag',
        )
            ->where('boats.is_dets','=',$type)

            // CAMBIO 28/04/2034 - Agregando Order By nameBoat ASC
            ->orderBy('nameBoat', 'asc')
        ->get();

        return [
            'boat' => $boats
        ];
    }
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $boats = new Boat();
        $boats->nameBoat = $request->nameBoat;
        $boats->enrollment = $request->enrollment;
        $boats->noPatent = $request->noPatent;
        $boats->noResolution = $request->noResolution;
        $boats->namerepresent = $request->nameRepresent;
        $boats->dateValidityPat = $request->dateValidityPat;
        $boats->dateValid = $request->dateValid;
        $boats->dateResolution = $request->dateResolution;

        $boats->id_flag = $request->id_flag;
        $boats->id_company = $request->id_company;
        $boats->save();
        $array = array(
            'res' => true,
            'message' => 'Registro guardado exitosamente'
            );
        return response()->json($array,201);
    }

    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $boats = Boat::findOrFail($request->id);
        $boats->nameBoat = $request->nameBoat;
        $boats->enrollment = $request->enrollment;
        $boats->noPatent = $request->noPatent;
        $boats->noResolution = $request->noResolution;
        $boats->namerepresent = $request->nameRepresent;
        $boats->dateValidityPat = $request->dateValidityPat;
        $boats->dateValid = $request->dateValid;
        $boats->dateResolution = $request->dateResolution;
        $boats->id_company = $request->id_company;
        $boats->id_flag = $request->id_flag;
        $boats->save();

        $array = array(
            'res' => true,
            'message' => 'Registro actualizado exitosamente'
            );
        return response()->json($array,201);
    }

    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $boats = Boat::findOrFail($request->id);
        $boats->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro se elimino exitosamente'
            );
        return response()->json($array,201);
    }
}
