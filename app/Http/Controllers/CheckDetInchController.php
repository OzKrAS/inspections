<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckDetInch;
use App\Company;
use App\Regional;
use App\DetailDetInch;
use App\DetailFisherAutDetInchs;

class CheckDetInchController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        if( auth()->user()->idrol == 1){
            $CheckDetInchs = CheckDetInch::join('companies','check_det_inches.id_company','=','companies.id')
            ->join('regionals','check_det_inches.id_regional','=','regionals.id')
            ->select('check_det_inches.id',
                     'check_det_inches.office',
                     'check_det_inches.official',
                     'check_det_inches.boat',
                     'check_det_inches.enrollment',
                    //  'check_det_inches.outhFhisher',
                     'check_det_inches.fishLicense',
                     'check_det_inches.owner',
                     'check_det_inches.fishCaptain',
                     'check_det_inches.location',
                     'check_det_inches.observation',
                     'check_det_inches.date',

                     'check_det_inches.flapMeshSize',
                     'check_det_inches.angleDet',
                     'check_det_inches.typeDet',
                     'check_det_inches.materialDet',
                     'check_det_inches.exit',
                     'check_det_inches.float',
                     
                     'check_det_inches.id_company','companies.name as nameCompany',
                     'check_det_inches.id_regional','regionals.name as nameRegional',
                     
            )
        
            ->paginate(9999999999999999999999999);
        }
        else {
            $CheckDetInchs = CheckDetInch::join('companies','check_det_inches.id_company','=','companies.id')
            ->join('regionals','check_det_inches.id_regional','=','regionals.id')
            ->select('check_det_inches.id',
                     'check_det_inches.office',
                     'check_det_inches.official',
                     'check_det_inches.boat',
                     'check_det_inches.enrollment',
                    //  'check_det_inches.outhFhisher',
                     'check_det_inches.fishLicense',
                     'check_det_inches.owner',
                     'check_det_inches.fishCaptain',
                     'check_det_inches.location',
                     'check_det_inches.observation',
                     'check_det_inches.date',

                     'check_det_inches.flapMeshSize',
                     'check_det_inches.angleDet',
                     'check_det_inches.typeDet',
                     'check_det_inches.materialDet',
                     'check_det_inches.exit',
                     'check_det_inches.float',
                     
                     'check_det_inches.id_company','companies.name as nameCompany',
                     'check_det_inches.id_regional','regionals.name as nameRegional'
                     
            )
            ->where('check_det_inches.user_id', '=', auth()->user()->id)
            ->paginate(9999999999999999999999999);
        }

        return [     
            'CheckDetInchs' => $CheckDetInchs
        ];
    }
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $CheckDetInchs = new CheckDetInch();
        $CheckDetInchs->user_id = $request->user_id;

        $CheckDetInchs->office = $request->office;
        $CheckDetInchs->official = $request->official;
        $CheckDetInchs->boat = $request->boat;
        $CheckDetInchs->enrollment = $request->enrollment;
        // $CheckDetInchs->outhFhisher = $request->outhFhisher;
        $CheckDetInchs->fishLicense = $request->fishLicense;
        $CheckDetInchs->owner = $request->owner;
        $CheckDetInchs->fishCaptain = $request->fishCaptain;
        $CheckDetInchs->location = $request->location;
        $CheckDetInchs->observation = $request->observation;
        $CheckDetInchs->date = $request->date;

        $CheckDetInchs->flapMeshSize = $request->flapMeshSize;
        $CheckDetInchs->angleDet = $request->angleDet;
        $CheckDetInchs->typeDet = $request->typeDet;
        $CheckDetInchs->materialDet = $request->materialDet;
        $CheckDetInchs->exit = $request->exit;
        $CheckDetInchs->float = $request->float;

        $CheckDetInchs->id_company = $request->id_company;  
        $CheckDetInchs->id_regional = $request->id_regional;  
        $CheckDetInchs->save();

        $detaildetinch = $request->detinch;
        foreach($detaildetinch as $ep=>$det){
            $objeto= new DetailDetInch();
            $objeto->id_detinch = $CheckDetInchs->id;
            $objeto->babor1= $det['babor1'];
            $objeto->babor2= $det['babor2'];
            $objeto->estribor1= $det['estribor1'];
            $objeto->estribor2= $det['estribor2'];
            $objeto->punto= $det['punto'];
            $objeto->tituloModal= $det['tituloModal'];
            $objeto->save();
        }

        $detailsfisheryDet = $request->data;
        foreach($detailsfisheryDet as $fs=>$deta){
            $objeto= new DetailFisherAutDetInchs();
            $objeto->id_fisheryAut = $CheckDetInchs->id;
            $objeto->name= $deta['name'];
            $objeto->save();
        }
        $array = array(
            'res' => true,
            'id' => $CheckDetInchs['id'],
            'message' => 'Registro guardado exitosamente'
            );
        return response()->json($array,201);
    }
    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $CheckDetInchs = CheckDetInch::findOrFail($request->id); 
        $CheckDetInchs->office = $request->office;
        $CheckDetInchs->official = $request->official;
        $CheckDetInchs->boat = $request->boat;
        $CheckDetInchs->enrollment = $request->enrollment;
        // $CheckDetInchs->outhFhisher = $request->outhFhisher;
        $CheckDetInchs->fishLicense = $request->fishLicense;
        $CheckDetInchs->owner = $request->owner;
        $CheckDetInchs->fishCaptain = $request->fishCaptain;
        $CheckDetInchs->location = $request->location;
        $CheckDetInchs->observation = $request->observation;
        $CheckDetInchs->date = $request->date; 

        $CheckDetInchs->flapMeshSize = $request->flapMeshSize;
        $CheckDetInchs->angleDet = $request->angleDet;
        $CheckDetInchs->typeDet = $request->typeDet;
        $CheckDetInchs->materialDet = $request->materialDet;
        $CheckDetInchs->exit = $request->exit;
        $CheckDetInchs->float = $request->float;

        $CheckDetInchs->id_company = $request->id_company;  
        $CheckDetInchs->id_regional = $request->id_regional;  
        $CheckDetInchs->save();

        $detaildetinch = $request->detinch;
        foreach($detaildetinch as $ep=>$det){
            $objeto= new DetailDetInch();
            $objeto->id_detinch = $CheckDetInchs->id;
            $objeto->babor1= $det['babor1'];
            $objeto->babor2= $det['babor2'];
            $objeto->estribor1= $det['estribor1'];
            $objeto->estribor2= $det['estribor2'];
            $objeto->punto= $det['punto'];
            $objeto->tituloModal= $det['tituloModal'];
            $objeto->save();
        }

        $detailsfisheryDet = $request->data;
        //delete all data
        // DetailFisherAutDetInchs::where('id_fisheryAut', $CheckDetInchs->id)->delete();
        $fishersAuth = DetailFisherAutDetInchs::where('id_fisheryAut', '=', $CheckDetInchs->id)->get();
        foreach ($fishersAuth as $fisher) {
           $fisher->delete();
        }


        foreach($detailsfisheryDet as $fs=>$deta){
            $objeto= new DetailFisherAutDetInchs();
            $objeto->id_fisheryAut = $CheckDetInchs->id;
            $objeto->name= $deta['name'];
            $objeto->save();
        }
        
        $array = array(
            'res' => true,
            'message' => 'Registro actualizado exitosamente'
            );
        return response()->json($array,201);
    }
    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $CheckDetInchs = CheckDetInch::findOrFail($request->id);
        $CheckDetInchs->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
            );
        return response()->json($array,201);
    }
    public function dataTable(Request $request)
    {
        $CheckDetInchs = DetailDetInch::select('id','id_detinch','babor1','babor2','estribor1','estribor2','punto','tituloModal')
        ->where('id_detinch', $request->id_Detnch)->get();
        return ['detinch' =>  $CheckDetInchs];   
    }
    public function dataFishery(Request $request)
    {
        $CheckDetInchs = DetailFisherAutDetInchs::select('id','id_fisheryAut','name')
        ->where('id_fisheryAut', $request->id_FisheryAut)->get();
        return ['fisheryAut' =>  $CheckDetInchs];   
    }
}
