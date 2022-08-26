<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arrival;
use App\Region;
use App\Flag;
use App\Nationality;
use App\AutoFisher;
use App\FisheryAuthorized;
use App\Company;
use App\DetailFisherAutArrival;
use App\DetTargCaptArrivals;
use App\DetFaunaCaptArrivals;
use App\FishingGearMaterial;

class ArrivalController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $arrivals = Arrival::join('regions','arrivals.id_region','=','regions.id')
            ->join('ports','arrivals.id_port','=','ports.id')
            ->join('flags','arrivals.id_flag','=','flags.id')
            ->join('nationalities','arrivals.id_nationality','=','nationalities.id')
            ->join('auto_fishers','arrivals.id_zoneAutoFisher','=','auto_fishers.id')
            // ->join('fishery_authorizeds','arrivals.id_fisheryAuthorized','=','fishery_authorizeds.id')
            ->join('companies','arrivals.id_company','=','companies.id')
            ->join('orops','arrivals.id_orop','=','orops.id')
            ->join('fishing_gear_materials','arrivals.id_material','=','fishing_gear_materials.id')
            ->select('arrivals.id',
                    'arrivals.insNo',
                    'arrivals.radioCall',
                    'arrivals.noResolution',
                    'arrivals.nameBoat',
                    'arrivals.enrollment',
                    'arrivals.noPatent',
                    'arrivals.eyeMesh',
                    'arrivals.netWidth',
                    'arrivals.eyeFlake',
                    'arrivals.typeHook',
                    'arrivals.longNet',
                    'arrivals.materialArt',
                    'arrivals.equipDevi',
                    'arrivals.captain',
                    'arrivals.noOmi',
                    'arrivals.totalLongline',
                    'arrivals.legalRepre',
                    'arrivals.noAllCrew',
                    'arrivals.noCrewForeign',
                    'arrivals.noCrewNational',
                    'arrivals.idOmi',
                    'arrivals.other',
                    'arrivals.noDays',
                    'arrivals.noAllHauls',
                    'arrivals.noHaulsNacional',
                    'arrivals.noHaulsInter',
                    'arrivals.landedWeight',
                    'arrivals.observation',
                    'arrivals.notification',
                    'arrivals.finalityArrival',
                    'arrivals.workDone',
                    'arrivals.locationSystem',
                    'arrivals.inspectorConclusions',
                    'arrivals.additionalComments',
                    'arrivals.dateIns',
                    'arrivals.dateScale',
                    'arrivals.dateZarpe',
                    'arrivals.dateLatestArrival',
                    'arrivals.dateValidityPat',
                    'arrivals.date',
                    'arrivals.dateValidity',
                    'arrivals.stateRectorPort',
                    'arrivals.observationGeneral',
                    'arrivals.id_portArrival',
                    'arrivals.id_portZarpe',

                    'arrivals.id_region','regions.name as nameReg',
                    'arrivals.id_port','ports.name as namePort',
                    'arrivals.id_flag','flags.name as nameFlag',
                    'arrivals.id_material','fishing_gear_materials.name as nameMaterial',
                    'arrivals.id_nationality','nationalities.name as nameNationality',
                    'arrivals.id_zoneAutoFisher','auto_fishers.name as nameZoneAutoFisher',
                    // 'arrivals.id_fisheryAuthorized','fishery_authorizeds.name as nameFishery',
                    'arrivals.id_company','companies.name as nameCompany',
                    'arrivals.id_orop','orops.name as nameOrop',
            )

            ->paginate(9999999999999999999999999);

        return [
            'arrivals' => $arrivals
        ];
    }
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $arrivals = new Arrival();
        $arrivals->insNo = $request->insNo;
        $arrivals->radioCall = $request->radioCall;
        $arrivals->noResolution = $request->noResolution;
        $arrivals->nameBoat = $request->nameBoat;
        $arrivals->enrollment = $request->enrollment;
        $arrivals->noPatent = $request->noPatent;
        $arrivals->eyeMesh = $request->eyeMesh;
        $arrivals->netWidth = $request->netWidth;
        $arrivals->eyeFlake = $request->eyeFlake;
        $arrivals->typeHook = $request->typeHook;
        $arrivals->longNet = $request->longNet;
        $arrivals->materialArt = $request->materialArt;
        $arrivals->equipDevi = $request->equipDevi;
        $arrivals->captain = $request->captain;
        $arrivals->noOmi = $request->noOmi;
        $arrivals->legalRepre = $request->legalRepre;
        $arrivals->noAllCrew = $request->noAllCrew;
        $arrivals->noCrewForeign = $request->noCrewForeign;
        $arrivals->noCrewNational = $request->noCrewNational;
        $arrivals->idOmi = $request->idOmi;
        $arrivals->other = $request->other;
        $arrivals->totalLongline = $request->totalLongline;
        $arrivals->noDays = $request->noDays;
        $arrivals->noAllHauls = $request->noAllHauls;
        $arrivals->noHaulsNacional = $request->noHaulsNacional;
        $arrivals->noHaulsInter = $request->noHaulsInter;
        $arrivals->landedWeight = $request->landedWeight;
        $arrivals->observation = $request->observation;
        $arrivals->notification = $request->notification;
        $arrivals->finalityArrival = $request->finalityArrival;
        $arrivals->workDone = $request->workDone;
        $arrivals->locationSystem = $request->locationSystem;
        $arrivals->inspectorConclusions = $request->inspectorConclusions;
        $arrivals->additionalComments = $request->additionalComments;
        $arrivals->dateIns = $request->dateIns;
        $arrivals->dateScale = $request->dateScale;
        $arrivals->dateZarpe = $request->dateZarpe;
        $arrivals->dateLatestArrival = $request->dateLatestArrival;
        $arrivals->dateValidityPat = $request->dateValidityPat;
        $arrivals->date = $request->date;
        $arrivals->dateValidity = $request->dateValidity;
        $arrivals->stateRectorPort = $request->stateRectorPort;
        $arrivals->observationGeneral = $request->observationGeneral;

        $arrivals->id_region = $request->id_region;
        $arrivals->id_port = $request->id_port;
        $arrivals->id_portZarpe = $request->id_portZarpe;
        $arrivals->id_portArrival = $request->id_portArrival;
        $arrivals->id_flag = $request->id_flag;
        $arrivals->id_nationality = $request->id_nationality;
        $arrivals->id_orop = $request->id_orop; 
        $arrivals->id_material = $request->id_material;
        $arrivals->id_zoneAutoFisher = $request->id_zoneAutoFisher;
        $arrivals->id_company = $request->id_company;
        $arrivals->save();


        $detailarrivals = $request->fishery;
        foreach($detailarrivals as $ep=>$det){
            $objeto= new DetailFisherAutArrival();
            $objeto->id_fisheryAut = $arrivals->id;
            $objeto->name= $det['name'];
            $objeto->save();
        }
        $detailarrivalstarget = $request->target;
        foreach($detailarrivalstarget as $ep=>$det){
            $objeto= new DetTargCaptArrivals();
            $objeto->id_target = $arrivals->id;
            $objeto->nameCommon1= $det['nameCommon1'];
            $objeto->nameScientific1= $det['nameScientific1'];
            $objeto->capture1= $det['capture1'];
            $objeto->save();
        }
        $detailarrivalsfauna = $request->fauna;
        foreach($detailarrivalsfauna as $ep=>$det){
            $objeto= new DetFaunaCaptArrivals();
            $objeto->id_fauna = $arrivals->id;
            $objeto->nameCommon2= $det['nameCommon2'];
            $objeto->nameScientific2= $det['nameScientific2'];
            $objeto->capture2= $det['capture2'];
            $objeto->save();
        }
     $array = array(
            'res' => true,
            'message' => 'Registro guardado exitosamente'
            );
        return response()->json($array,201);


    }

    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $arrivals = Arrival::findOrFail($request->id);
        $arrivals->insNo = $request->insNo;
        $arrivals->radioCall = $request->radioCall;
        $arrivals->noResolution = $request->noResolution;
        $arrivals->nameBoat = $request->nameBoat;
        $arrivals->enrollment = $request->enrollment;
        $arrivals->noPatent = $request->noPatent;
        $arrivals->eyeMesh = $request->eyeMesh;
        $arrivals->netWidth = $request->netWidth;
        $arrivals->eyeFlake = $request->eyeFlake;
        $arrivals->typeHook = $request->typeHook;
        $arrivals->longNet = $request->longNet;
        $arrivals->materialArt = $request->materialArt;
        $arrivals->equipDevi = $request->equipDevi;
        $arrivals->captain = $request->captain;
        $arrivals->noOmi = $request->noOmi;
        $arrivals->legalRepre = $request->legalRepre;
        $arrivals->noAllCrew = $request->noAllCrew;
        $arrivals->noCrewForeign = $request->noCrewForeign;
        $arrivals->noCrewNational = $request->noCrewNational;
        $arrivals->idOmi = $request->idOmi;
        $arrivals->other = $request->other;
        $arrivals->totalLongline = $request->totalLongline;
        $arrivals->noDays = $request->noDays;
        $arrivals->noAllHauls = $request->noAllHauls;
        $arrivals->noHaulsNacional = $request->noHaulsNacional;
        $arrivals->noHaulsInter = $request->noHaulsInter;
        $arrivals->landedWeight = $request->landedWeight;
        $arrivals->observation = $request->observation;
        $arrivals->notification = $request->notification;
        $arrivals->finalityArrival = $request->finalityArrival;
        $arrivals->workDone = $request->workDone;
        $arrivals->locationSystem = $request->locationSystem;
        $arrivals->inspectorConclusions = $request->inspectorConclusions;
        $arrivals->additionalComments = $request->additionalComments;
        $arrivals->dateIns = $request->dateIns;
        $arrivals->dateScale = $request->dateScale;
        $arrivals->dateZarpe = $request->dateZarpe;
        $arrivals->dateLatestArrival = $request->dateLatestArrival;
        $arrivals->dateValidityPat = $request->dateValidityPat;
        $arrivals->date = $request->date;
        $arrivals->dateValidity = $request->dateValidity;
        $arrivals->stateRectorPort = $request->stateRectorPort;
        $arrivals->observationGeneral = $request->observationGeneral;

        $arrivals->id_region = $request->id_region;
        $arrivals->id_port = $request->id_port;
        $arrivals->id_portZarpe = $request->id_portZarpe;
        $arrivals->id_portArrival = $request->id_portArrival;
        $arrivals->id_flag = $request->id_flag;
        $arrivals->id_nationality = $request->id_nationality;
        $arrivals->id_zoneAutoFisher = $request->id_zoneAutoFisher;
        $arrivals->id_orop = $request->id_orop;
        $arrivals->id_material = $request->id_material;
        // $arrivals->id_fisheryAuthorized = $request->id_fisheryAuthorized;
        $arrivals->id_company = $request->id_company;
        $arrivals->save();


        // $detailarrivals = $request->fishery;
        // foreach($detailarrivals as $ep=>$det){
        //     $objeto= new DetailFisherAutArrival();
        //     $objeto->id_fisheryAut = $arrivals->id;
        //     $objeto->name= $det['name'];
        //     $objeto->save();
        // }
        $detailarrivalstarget = $request->target;
        foreach($detailarrivalstarget as $ep=>$det){
            $objeto= new DetTargCaptArrivals();
            $objeto->id_target = $arrivals->id;
            $objeto->nameCommon1= $det['nameCommon1'];
            $objeto->nameScientific1= $det['nameScientific1'];
            $objeto->capture1= $det['capture1'];
            $objeto->save();
        }
        $detailarrivalsfauna = $request->fauna;
        foreach($detailarrivalsfauna as $ep=>$det){
            $objeto= new DetFaunaCaptArrivals();
            $objeto->id_fauna = $arrivals->id;
            $objeto->nameCommon2= $det['nameCommon2'];
            $objeto->nameScientific2= $det['nameScientific2'];
            $objeto->capture2= $det['capture2'];
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
        $arrivals = Arrival::findOrFail($request->id);
        $arrivals->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
            );
        return response()->json($array,201);
    }
    public function dataTarget(Request $request)
    {
        $arrivals = DetTargCaptArrivals::select('id','id_target','nameCommon1','nameScientific1','capture1')
        ->where('id_target', $request->id_Target)->get();
        return ['target' =>  $arrivals];
    }
    public function dataFauna(Request $request)
    {
        $arrivals = DetFaunaCaptArrivals::select('id','id_fauna','nameCommon2','nameScientific2','capture2')
        ->where('id_fauna', $request->id_Fauna)->get();
        return ['fauna' =>  $arrivals];
    }
    public function dataFishery(Request $request)
    {
        $arrivals = DetailFisherAutArrival::select('id','id_fisheryAut','name')
        ->where('id_fisheryAut', $request->id_FisheryAut)->get();
        return ['fisheryAut' =>  $arrivals];
    }
}