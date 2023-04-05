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
use App\DetailImgArrival;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Image;

class ArrivalController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $arrivals = Arrival::join('regions','arrivals.id_region','=','regions.id')
            ->join('docks','arrivals.id_port','=','docks.id')
            ->join('ports','docks.id_port','=','ports.id')
            ->join('flags','arrivals.id_flag','=','flags.id')
            ->join('nationalities','arrivals.id_nationality','=','nationalities.id')
            ->join('auto_fishers','arrivals.id_zoneAutoFisher','=','auto_fishers.id')
            // ->join('fishery_authorizeds','arrivals.id_fisheryAuthorized','=','fishery_authorizeds.id')
            ->join('companies','arrivals.id_company','=','companies.id')
            ->join('orops','arrivals.id_orop','=','orops.id')
            ->join('fishing_gear_materials','arrivals.id_material','=','fishing_gear_materials.id')
            ->selectRaw("CONCAT(ports.name, ' - ', docks.name) as namePlace,arrivals.id,
                    arrivals.insNo,
                    arrivals.radioCall,
                    arrivals.noResolution,
                    arrivals.nameBoat,
                    arrivals.enrollment,
                    arrivals.noPatent,
                    arrivals.eyeMesh,
                    arrivals.netWidth,
                    arrivals.eyeFlake,
                    arrivals.typeHook,
                    arrivals.longNet,
                    arrivals.materialArt,
                    arrivals.equipDevi,
                    arrivals.captain,
                    arrivals.noOmi,
                    arrivals.totalLongline,
                    arrivals.legalRepre,
                    arrivals.noAllCrew,
                    arrivals.noCrewForeign,
                    arrivals.noCrewNational,
                    arrivals.idOmi,
                    arrivals.other,
                    arrivals.noDays,
                    arrivals.noAllHauls,
                    arrivals.noHaulsNacional,
                    arrivals.noHaulsInter,
                    arrivals.landedWeight,
                    arrivals.observation,
                    arrivals.notification,
                    arrivals.finalityArrival,
                    arrivals.workDone,
                    arrivals.locationSystem,
                    arrivals.inspectorConclusions,
                    arrivals.additionalComments,
                    arrivals.dateIns,
                    arrivals.dateScale,
                    arrivals.dateZarpe,
                    arrivals.dateLatestArrival,
                    arrivals.dateValidityPat,
                    arrivals.date,
                    arrivals.dateValidity,
                    arrivals.stateRectorPort,
                    arrivals.observationGeneral,
                    arrivals.id_portArrival,
                    arrivals.id_portZarpe,

                    arrivals.id_region,regions.name as nameReg,
                    arrivals.id_port,ports.name as namePort,
                    arrivals.id_flag,flags.name as nameFlag,
                    arrivals.id_material,fishing_gear_materials.name as nameMaterial,
                    arrivals.id_nationality,nationalities.name as nameNationality,
                    arrivals.id_zoneAutoFisher,auto_fishers.name as nameZoneAutoFisher,
                    arrivals.id_company,companies.name as nameCompany,
                    arrivals.id_orop,orops.name as nameOrop"
            )

            ->paginate(9999999999999999999999999);

        return [
            'arrivals' => $arrivals
        ];
    }
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();
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
        //   $arrivals = Arrival::create([
               // 'insNo' => $request->insNo,
                // 'radioCall' => $request->radioCall,
                // 'noResolution' => $request->noResolution,
                // 'nameBoat' => $request->nameBoat,
                // 'enrollment' => $request->enrollment,
                // 'noPatent' => $request->noPatent,
                // 'eyeMesh' => $request->eyeMesh,
                // 'netWidth' => $request->netWidth,
                // 'eyeFlake' => $request->eyeFlake,
                // 'typeHook' => $request->typeHook,
                // 'longNet' => $request->longNet,
                // 'materialArt' => $request->materialArt,
                // 'equipDevi' => $request->equipDevi,
                // 'captain' => $request->captain,
                // 'noOmi' => $request->noOmi,
                // 'legalRepre' => $request->legalRepre,
                // 'noAllCrew' => $request->noAllCrew,
                // 'noCrewForeign' => $request->noCrewForeign,
                // 'noCrewNational' => $request->noCrewNational,
                // 'idOmi' => $request->idOmi,
                // 'other' => $request->other,
                // 'totalLongline' => $request->totalLongline,
                // 'noDays' => $request->noDays,
                // 'noAllHauls' => $request->noAllHauls,
                // 'noHaulsNacional' => $request->noHaulsNacional,
                // 'noHaulsInter' => $request->noHaulsInter,
                // 'landedWeight' => $request->landedWeight,
                // 'observation' => $request->observation,
                // 'notification' => $request->notification,
                // 'finalityArrival' => $request->finalityArrival,
                // 'workDone' => $request->workDone,
                // 'locationSystem' => $request->locationSystem,
                // 'inspectorConclusions' => $request->inspectorConclusions,
                // 'additionalComments' => $request->additionalComments,
                // 'dateIns' => $request->dateIns,
                // 'dateScale' => $request->dateScale,
                // 'dateZarpe' => $request->dateZarpe,
                // 'dateLatestArrival' => $request->dateLatestArrival,
                // 'dateValidityPat' => $request->dateValidityPat,
                // 'date' => $request->date,
                // 'dateValidity' => $request->dateValidity,
                // 'stateRectorPort' => $request->stateRectorPort,
                // 'observationGeneral' => $request->observationGeneral,

                // 'id_region' => $request->id_region,
                // 'id_port' => $request->id_port,
                // 'id_portZarpe' => $request->id_portZarpe,
                // 'id_portArrival' => $request->id_portArrival,
                // 'id_flag' => $request->id_flag,
                //     'id_nationality' => $request->id_nationality,
                //     'id_orop' => $request->id_orop,
                //     'id_material' => $request->id_material,
                //     'id_zoneAutoFisher' => $request->id_zoneAutoFisher,
                //     'id_company' => $request->id_company
                //     ]);



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

        // if($request->sendImg==1){
        //     $this->savePhotoIMG($arrivals, $request);
        // }else{
        //     $this->savePhoto($arrivals, $request);
        // }


        DB::commit();
     $array = array(
            'res' => true,
            'id'=>$arrivals['id'],
            'message' => 'Registro guardado exitosamente'
            );


            return response()->json($array,201);


        } catch (\Exception $ex) {
            DB::rollBack();
               return response()->json(['status' => 'fail', 'msg' => 'Ha ocurrido un error al procesar la solicitud '.$ex->getMessage()], 500);


    }
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
    public function savePhoto($solicitud, $request)
    {

        if(empty($request->images)){

        foreach($request->images as $ep=>$det){
        $is_update_photo = strpos($det['img1'], 'data:image');
        //Log::debug('FishermanController->savePhoto isUpdate: ' . $is_update_photo === 0);
            if (!empty($det['img1']) && $is_update_photo === 0) {
                $exploded = explode(',', $det['img1']);
                $decoded = base64_decode($exploded[1]);
                if (Str::contains($exploded[0], 'jpeg') || Str::contains($exploded[0], 'jpg')) {
                    $extension = 'jpg';
                } else {
                    $extension = 'png';
                }
                $fileName = 'arrivals-' . $solicitud->nameBoat . '-' . Str::random(10) . '.' . $extension;
                $path = public_path('img-arrivals-request/') . '/' . $fileName;
                file_put_contents($path, $decoded);
                $arrivals = new DetailImgArrival();
                $arrivals->path = $fileName;
                $arrivals->id_arrival = $solicitud->id;
                $arrivals->save();

            //     $array = array(
            //     'res' => true,
            //     'message' => 'Registro actualizado exitosamente'
            //     );
            // return response()->json($array,201);
            }
        }

    }

    }
    public function storeImg(Request $request){

        $img = $request->images;

        $ruta = public_path('img-arrivals-request/');

        $i=0;
        if(count($request->images)){

            foreach($request->images as $image){


                $filename = 'arrivals-' . Str::random(10). '-'.$image->getClientOriginalName();
                $upload_success = $image->move($ruta, $filename);

                 $demo = new DetailImgArrival();
                 $demo->path =  '/img-arrivals-request/'.$filename;
                 $demo->id_arrival = 160;
                 $demo->save();
                $i++;

            }
        }
    }
}