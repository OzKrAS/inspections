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
            ->join('fishery_authorizeds','arrivals.id_fisheryAuthorized','=','fishery_authorizeds.id')
            ->join('companies','arrivals.id_company','=','companies.id')
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
                    'arrivals.legalRepre',
                    'arrivals.noAllCrew',
                    'arrivals.noCrewForeign',
                    'arrivals.noCrewNational',
                    'arrivals.noDays',
                    'arrivals.noAllHauls',
                    'arrivals.noHaulsNacional',
                    'arrivals.noHaulsInter',
                    'arrivals.landedWeight',
                    'arrivals.observation',
                    'arrivals.notification',
                    'arrivals.finalityArrival',
                    'arrivals.origin',
                    'arrivals.destination',
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

                    'arrivals.id_region','regions.name as nameReg',
                    'arrivals.id_port','ports.name as namePort',
                    'arrivals.id_flag','flags.name as nameFlag',
                    'arrivals.id_nationality','nationalities.name as nameNationality',
                    'arrivals.id_zoneAutoFisher','auto_fishers.name as nameZoneAutoFisher',
                    'arrivals.id_fisheryAuthorized','fishery_authorizeds.name as nameFishery',
                    'arrivals.id_company','companies.name as nameCompany',
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
        $arrivals->noDays = $request->noDays;
        $arrivals->noAllHauls = $request->noAllHauls;
        $arrivals->noHaulsNacional = $request->noHaulsNacional;
        $arrivals->noHaulsInter = $request->noHaulsInter;
        $arrivals->landedWeight = $request->landedWeight;
        $arrivals->observation = $request->observation;
        $arrivals->notification = $request->notification;
        $arrivals->finalityArrival = $request->finalityArrival;
        $arrivals->origin = $request->origin;
        $arrivals->destination = $request->destination;
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
        $arrivals->id_fisheryAuthorized = $request->id_fisheryAuthorized;    
        $arrivals->id_company = $request->id_company; 
        $arrivals->save();

        // $detailarrivals = $request->fishery;
        // foreach($detailarrivals as $ep=>$det){
        //     $objeto= new DetConfiscationReasons();
        //     $objeto->id_arrival = $arrival->id;
        //     $objeto->name= $det['name'];
        //     $objeto->save();
        // }
        // $detailarrivals = $request->target;
        // foreach($detailarrivals as $ep=>$det){
        //     $objeto= new DetConfiscationReasons();
        //     $objeto->id_arrival = $arrival->id;
        //     $objeto->name= $det['name'];
        //     $objeto->save();
        // }
        // $detailarrivals = $request->fauna;
        // foreach($detailarrivals as $ep=>$det){
        //     $objeto= new DetConfiscationReasons();
        //     $objeto->id_arrival = $arrival->id;
        //     $objeto->name= $det['name'];
        //     $objeto->save();
        // }

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
        $arrivals->noDays = $request->noDays;
        $arrivals->noAllHauls = $request->noAllHauls;
        $arrivals->noHaulsNacional = $request->noHaulsNacional;
        $arrivals->noHaulsInter = $request->noHaulsInter;
        $arrivals->landedWeight = $request->landedWeight;
        $arrivals->observation = $request->observation;
        $arrivals->notification = $request->notification;
        $arrivals->finalityArrival = $request->finalityArrival;
        $arrivals->origin = $request->origin;
        $arrivals->destination = $request->destination;
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
        $arrivals->id_fisheryAuthorized = $request->id_fisheryAuthorized; 
        $arrivals->id_company = $request->id_company; 
        $arrivals->save();
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
}
