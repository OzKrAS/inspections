<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PresenVerific;
use App\Flag;

class PresenVerificController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $presenVerifics = PresenVerific::join('flags','presen_verifics.id_flag','=','flags.id')
            ->select('presen_verifics.id',
                     'nameShip',
                     'cruise',
                     'nameFish',
                     'nameCaptain',
                     'dateZarpe',
                     'dateDesemb',
                     
                     'presen_verifics.id_flag','flags.name as nameFlag'
            )
        
            ->paginate(9999999999999999999999999);
        
        return [
            'presenVerifics' => $presenVerifics
        ];
    }   
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $presenVerifics = new PresenVerific(); 
        $presenVerifics->nameShip = $request->nameShip;
        $presenVerifics->cruise = $request->cruise;
        $presenVerifics->nameFish = $request->nameFish;
        $presenVerifics->nameCaptain = $request->nameCaptain;
        $presenVerifics->dateZarpe = $request->dateZarpe;
        $presenVerifics->dateDesemb = $request->dateDesemb;
         
        $presenVerifics->id_flag = $request->id_flag;    
        $presenVerifics->save();
        $array = array(
            'res' => true,
            'message' => 'Registro guardado exitosamente'
            );
        return response()->json($array,201);
    }

    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $presenVerifics = PresenVerific::findOrFail($request->id);  
        $presenVerifics->nameShip = $request->nameShip;
        $presenVerifics->cruise = $request->cruise;
        $presenVerifics->nameFish = $request->nameFish;
        $presenVerifics->nameCaptain = $request->nameCaptain;
        $presenVerifics->dateZarpe = $request->dateZarpe;
        $presenVerifics->dateDesemb = $request->dateDesemb;
         
        $presenVerifics->id_flag = $request->id_flag;  
        $presenVerifics->save();
        $array = array(
            'res' => true,
            'message' => 'Registro actualizado exitosamente'
            );
        return response()->json($array,201);
    }

    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $presenVerifics = PresenVerific::findOrFail($request->id);
        $presenVerifics->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
            );
        return response()->json($array,201);
    }
}
