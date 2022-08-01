<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PresenVerific;
use App\Flag;
use App\DetPresenVerific;

class presenVerificController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $presenVerifics = PresenVerific::join('flags','presen_verifics.id_flag','=','flags.id')
            ->select('presen_verifics.id',
                     'presen_verifics.nameShip',
                     'presen_verifics.cruise',
                     'presen_verifics.nameFish',
                     'presen_verifics.nameCaptain',
                     'presen_verifics.dateZarpe',
                     'presen_verifics.dateDesemb',
                     
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
        
        $detpresenverific = $request->target;
        foreach($detpresenverific as $ep=>$det){
            $objeto= new DetPresenVerific();
            $objeto->id_presenVerific = $presenVerifics->id;
            $objeto->element = $det['element'];
            $objeto->zarpe = $det['zarpe'];
            $objeto->characterState = $det['characterState'];
            $objeto->regFot = $det['regFot'];
            $objeto->observation = $det['observation'];

            $objeto->save();
        }

        // $presenVerifics->save();
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

        $detpresenverific = $request->target;
        foreach($detpresenverific as $ep=>$det){
            $objeto= new DetPresenVerific();
            $objeto->id_presenVerific = $presenVerifics->id;
            $objeto->element = $det['element'];
            $objeto->zarpe = $det['zarpe'];
            $objeto->characterState = $det['characterState'];
            $objeto->regFot = $det['regFot'];
            $objeto->observation = $det['observation'];

            $objeto->save();
        }

        // $presenVerifics->save();
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

    public function dataTable(Request $request)
    {
        $presenVerifics = DetPresenVerific::select('id','id_presenVerific','element','zarpe','characterState','regFot','observation')
        ->where('id_presenVerific', $request->id_PresenVerific)->get();
        return ['presenVerific' =>  $presenVerifics];   
    }
}
