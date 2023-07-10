<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckDetFlap;
use App\Company;
use App\Regional;
use App\DetailDetFlap;
use App\DetailFisherAutDetFl;

class CheckDetFlapController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = CheckDetFlap::join('companies','check_det_flaps.id_company','=','companies.id')
            ->join('regionals','check_det_flaps.id_regional','=','regionals.id')
            ->select('check_det_flaps.id',
                     'check_det_flaps.office',
                     'check_det_flaps.official',
                     'check_det_flaps.boat',
                     'check_det_flaps.enrollment',
                    //  'check_det_flaps.outhFhisher',
                     'check_det_flaps.fishLicense',
                     'check_det_flaps.owner',
                     'check_det_flaps.fishCaptain',
                     'check_det_flaps.location',
                     'check_det_flaps.observation',
                     'check_det_flaps.date',

                     'check_det_flaps.flapMeshSize',
                     'check_det_flaps.angleDet',
                     'check_det_flaps.typeDet',
                     'check_det_flaps.materialDet',
                     'check_det_flaps.exit',
                     'check_det_flaps.float',
                     
                     'check_det_flaps.id_company','companies.name as nameCompany',
                     'check_det_flaps.id_regional','regionals.name as nameRegional',
                     
            )
        
            ->paginate(9999999999);

        return [     
            'checkDetFlaps' => $checkDetFlaps
        ];
    }
    public function store(Request $request)
    {
        
       // if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = new CheckDetFlap();
        $checkDetFlaps->office = $request->office;
        $checkDetFlaps->official = $request->official;
        $checkDetFlaps->boat = $request->boat;
        $checkDetFlaps->enrollment = $request->enrollment;
        // $checkDetFlaps->outhFhisher = $request->outhFhisher;
        $checkDetFlaps->fishLicense = $request->fishLicense;
        $checkDetFlaps->owner = $request->owner;
        $checkDetFlaps->fishCaptain = $request->fishCaptain;
        $checkDetFlaps->location = $request->location;
        $checkDetFlaps->observation = $request->observation;
        $checkDetFlaps->date = $request->date;

        $checkDetFlaps->flapMeshSize = $request->flapMeshSize;
        $checkDetFlaps->angleDet = $request->angleDet;
        $checkDetFlaps->typeDet = $request->typeDet;
        $checkDetFlaps->materialDet = $request->materialDet;
        $checkDetFlaps->exit = $request->exit;
        $checkDetFlaps->float = $request->float;

        $checkDetFlaps->id_company = $request->id_company;  
        $checkDetFlaps->id_regional = $request->id_regional;  
        $checkDetFlaps->save();

        $detaildetflap = $request->detflap;
        foreach($detaildetflap as $ep=>$det){
            $objeto= new DetailDetFlap();
            $objeto->id_detflap = $checkDetFlaps->id;
            $objeto->babor3= $det['babor3'];
            $objeto->babor4= $det['babor4'];
            $objeto->estribor3= $det['estribor3'];
            $objeto->estribor4= $det['estribor4'];
            $objeto->punto2= $det['punto2'];
            $objeto->tituloModal= $det['tituloModal'];
            $objeto->save();
        }
        $detailsfisheryDet = $request->data;
        foreach($detailsfisheryDet as $fs=>$deta){
            $objeto= new DetailFisherAutDetFl();
            $objeto->id_fisheryAut = $checkDetFlaps->id;
            $objeto->name= $deta['name'];
            $objeto->save();
        }
        $array = array(
            'res' => true,
            'check' => $checkDetFlaps,
            'message' => 'Registro guardado exitosamente'
        );
        return response()->json($array,201);
    }
    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = CheckDetFlap::findOrFail($request->id); 
        $checkDetFlaps->office = $request->office;
        $checkDetFlaps->official = $request->official;
        $checkDetFlaps->boat = $request->boat;
        $checkDetFlaps->enrollment = $request->enrollment;
        // $checkDetFlaps->outhFhisher = $request->outhFhisher;
        $checkDetFlaps->fishLicense = $request->fishLicense;
        $checkDetFlaps->owner = $request->owner;
        $checkDetFlaps->fishCaptain = $request->fishCaptain;
        $checkDetFlaps->location = $request->location;
        $checkDetFlaps->observation = $request->observation;
        $checkDetFlaps->date = $request->date; 

        $checkDetFlaps->flapMeshSize = $request->flapMeshSize;
        $checkDetFlaps->angleDet = $request->angleDet;
        $checkDetFlaps->typeDet = $request->typeDet;
        $checkDetFlaps->materialDet = $request->materialDet;
        $checkDetFlaps->exit = $request->exit;
        $checkDetFlaps->float = $request->float;

        $checkDetFlaps->id_company = $request->id_company; 
        $checkDetFlaps->id_regional = $request->id_regional; 
        $checkDetFlaps->save();

        $detaildetflap = $request->detflap;
        foreach($detaildetflap as $ep=>$det){
            $objeto= new DetailDetFlap();
            $objeto->id_detflap = $checkDetFlaps->id;
            $objeto->babor3= $det['babor3'];
            $objeto->babor4= $det['babor4'];
            $objeto->estribor3= $det['estribor3'];
            $objeto->estribor4= $det['estribor4'];
            $objeto->punto2= $det['punto2'];
            $objeto->tituloModal= $det['tituloModal'];
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
        $checkDetFlaps = CheckDetFlap::findOrFail($request->id);
        $checkDetFlaps->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro se elimino exitosamente'
            );
        return response()->json($array,201);        
    }
    public function dataTable(Request $request)
    {
        $checkDetFlaps = DetailDetFlap::select('id','id_detflap','babor3','babor4','estribor3','estribor4','punto2','tituloModal')
        ->where('id_detflap', $request->id_Detflap)->get();
        return ['detflap' =>  $checkDetFlaps];   
    }
    public function dataFishery(Request $request)
    {
        $checkDetFlaps = DetailFisherAutDetFl::select('id','id_fisheryAut','name')
        ->where('id_fisheryAut', $request->id_FisheryAut)->get();
        return ['fisheryAut' =>  $checkDetFlaps];   
    }
}
