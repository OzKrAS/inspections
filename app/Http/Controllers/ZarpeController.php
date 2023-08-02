<?php

namespace App\Http\Controllers;

use App\DetailFisherAutZarpe;
use App\Dock;
use App\Zarpe;
use App\User;
use App\Boat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZarpeController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $docks = Dock::join('ports', 'docks.id_port', '=', 'ports.id')
            ->select(
                'docks.id',
                DB::raw('CONCAT(ports.name, " / ", docks.name) as fullDockName')
            )->toSql();

        if( auth()->user()->idrol == 1 ){
            $zarpes = Zarpe::join('municipalities', 'zarpes.id_municipalities', '=', 'municipalities.id')
            ->join('regions', 'municipalities.id_region', '=', 'regions.id')
            ->join(DB::raw("({$docks}) as docksAndPorts"), function ($join) {
                $join->on('zarpes.id_docks', '=', 'docksAndPorts.id');
            })
            ->join('docks', 'zarpes.id_docks', '=', 'docks.id')
            ->join(DB::raw("($docks) as port_zarpe"), function($join){
                $join->on('zarpes.id_portZarpe', '=', 'port_zarpe.id');
            })
            ->join(DB::raw("($docks) as port_arrival"), function($join){
                $join->on('zarpes.id_portArrival', '=', 'port_arrival.id');
            })
            ->join('ports', 'zarpes.id_portZarpe', '=', 'ports.id')
            ->join('flags', 'zarpes.id_flag', '=', 'flags.id')
            ->join('fishing_gear_materials', 'zarpes.id_material', '=', 'fishing_gear_materials.id')
            ->join('nationalities', 'zarpes.id_nationality', '=', 'nationalities.id')
            ->join('orops', 'zarpes.id_orop', '=', 'orops.id')
            ->join('auto_fishers', 'zarpes.id_zoneAutoFisher', '=', 'auto_fishers.id')
            ->join('companies', 'zarpes.id_company', '=', 'companies.id')
            ->selectRaw("CONCAT(ports.name, ' - ', docks.name) as namePlace,zarpes.id,
                    zarpes.insNo,
                    zarpes.radioCall,
                    zarpes.idOmi,
                    zarpes.noResolution,
                    zarpes.nameBoat,
                    zarpes.enrollment,
                    zarpes.noPatent,
                    zarpes.representative,
                    zarpes.eyeMesh,
                    zarpes.netWidth,
                    zarpes.eyeFlake,
                    zarpes.typeHook,
                    zarpes.longNet,
                    zarpes.totalLongline,
                    zarpes.other,
                    zarpes.equipDevi,
                    zarpes.captain,
                    zarpes.observation,
                    zarpes.observationGeneral,
                    zarpes.conclusions,
                    zarpes.comments,
                    zarpes.dateIns,
                    zarpes.dateZarpe,
                    zarpes.dateResolution,
                    zarpes.dateValid,
                    zarpes.dateLatestArrival,
                    zarpes.dateValidityPat,
                    zarpes.notification,
                    zarpes.finalityZarpe,
                    zarpes.national,
                    zarpes.autorization,
                    zarpes.id_portZarpe,
                    zarpes.id_portArrival,
                    zarpes.id_municipalities,
                    CONCAT(municipalities.name, ' ', regions.name) as nameReg,
                    zarpes.id_docks, docks.name as namePort,
                    zarpes.id_flag,flags.name as nameFlag,
                    zarpes.id_material,fishing_gear_materials.name as nameMaterial,
                    zarpes.id_nationality,nationalities.name as nameNationality,
                    zarpes.id_orop,orops.name as nameOrop,
                    zarpes.id_zoneAutoFisher,auto_fishers.name as nameZoneAutoFisher,
                    zarpes.id_company,companies.name as nameCompany,
                    port_zarpe.fullDockName as nameportZarpe,
                    port_arrival.fullDockName as nameportArrival,
                    docksAndPorts.fullDockName as nameDock,
                    zarpes.id_boat"
            )->paginate(999999999);
        }
        else {
            $zarpes = Zarpe::join('municipalities', 'zarpes.id_municipalities', '=', 'municipalities.id')
            ->join('regions', 'municipalities.id_region', '=', 'regions.id')
            ->join(DB::raw("({$docks}) as docksAndPorts"), function ($join) {
                $join->on('zarpes.id_docks', '=', 'docksAndPorts.id');
            })
            ->join('docks', 'zarpes.id_docks', '=', 'docks.id')
            ->join(DB::raw("($docks) as port_zarpe"), function($join){
                $join->on('zarpes.id_portZarpe', '=', 'port_zarpe.id');
            })
            ->join(DB::raw("($docks) as port_arrival"), function($join){
                $join->on('zarpes.id_portArrival', '=', 'port_arrival.id');
            })
            ->join('ports', 'zarpes.id_portZarpe', '=', 'ports.id')
            ->join('flags', 'zarpes.id_flag', '=', 'flags.id')
            ->join('fishing_gear_materials', 'zarpes.id_material', '=', 'fishing_gear_materials.id')
            ->join('nationalities', 'zarpes.id_nationality', '=', 'nationalities.id')
            ->join('orops', 'zarpes.id_orop', '=', 'orops.id')
            ->join('auto_fishers', 'zarpes.id_zoneAutoFisher', '=', 'auto_fishers.id')
            ->join('companies', 'zarpes.id_company', '=', 'companies.id')
            ->selectRaw("CONCAT(ports.name, ' - ', docks.name) as namePlace,zarpes.id,
                    zarpes.insNo,
                    zarpes.radioCall,
                    zarpes.idOmi,
                    zarpes.noResolution,
                    zarpes.nameBoat,
                    zarpes.enrollment,
                    zarpes.noPatent,
                    zarpes.representative,
                    zarpes.eyeMesh,
                    zarpes.netWidth,
                    zarpes.eyeFlake,
                    zarpes.typeHook,
                    zarpes.longNet,
                    zarpes.totalLongline,
                    zarpes.other,
                    zarpes.equipDevi,
                    zarpes.captain,
                    zarpes.observation,
                    zarpes.observationGeneral,
                    zarpes.conclusions,
                    zarpes.comments,
                    zarpes.dateIns,
                    zarpes.dateZarpe,
                    zarpes.dateResolution,
                    zarpes.dateValid,
                    zarpes.dateLatestArrival,
                    zarpes.dateValidityPat,
                    zarpes.notification,
                    zarpes.finalityZarpe,
                    zarpes.national,
                    zarpes.autorization,
                    zarpes.id_portZarpe,
                    zarpes.id_portArrival,
                    zarpes.id_municipalities,
                    CONCAT(municipalities.name, ' ', regions.name) as nameReg,
                    zarpes.id_docks, docks.name as namePort,
                    zarpes.id_flag,flags.name as nameFlag,
                    zarpes.id_material,fishing_gear_materials.name as nameMaterial,
                    zarpes.id_nationality,nationalities.name as nameNationality,
                    zarpes.id_orop,orops.name as nameOrop,
                    zarpes.id_zoneAutoFisher,auto_fishers.name as nameZoneAutoFisher,
                    zarpes.id_company,companies.name as nameCompany,
                    port_zarpe.fullDockName as nameportZarpe,
                    port_arrival.fullDockName as nameportArrival,
                    docksAndPorts.fullDockName as nameDock,
                    zarpes.id_boat"
            )
            ->where('zarpes.user_id', '=', auth()->user()->id)
            ->paginate(999999999);
        }

        return [
            'zarpes' => $zarpes
        ];
    }

    public function store(Request $request)
    {

        // if (!$request->ajax()) return redirect('/');

        $zarpes = new Zarpe();
        $zarpes->user_id = $request->user_id;
        $zarpes->insNo = $request->insNo;
        $zarpes->radioCall = $request->radioCall;
        $zarpes->idOmi = $request->idOmi;
        $zarpes->noResolution = $request->noResolution;
        
        $zarpes->nameBoat = $request->nameBoat;
        $boats = Boat::where('nameBoat', '=', $zarpes->nameBoat)->get();

        $zarpes->enrollment = $request->enrollment;
        $zarpes->noPatent = $request->noPatent;
        $zarpes->representative = $request->representative;
        $zarpes->eyeMesh = $request->eyeMesh;
        $zarpes->netWidth = $request->netWidth;
        $zarpes->eyeFlake = $request->eyeFlake;
        $zarpes->typeHook = $request->typeHook;
        $zarpes->longNet = $request->longNet;
        $zarpes->totalLongline = $request->totalLongline;
        $zarpes->other = $request->other;
        // $zarpes->materialArt = $request->materialArt;
        $zarpes->equipDevi = $request->equipDevi;
        $zarpes->captain = $request->captain;
        $zarpes->observation = $request->observation;
        $zarpes->observationGeneral = $request->observationGeneral;
        $zarpes->conclusions = $request->conclusions;
        $zarpes->comments = $request->comments;
        $zarpes->dateIns = $request->dateIns;
        $zarpes->dateZarpe = $request->dateZarpe;
        $zarpes->dateResolution = $request->dateResolution;
        $zarpes->dateValid = $request->dateValid;
        $zarpes->dateLatestArrival = $request->dateLatestArrival;
        $zarpes->dateValidityPat = $request->dateValidityPat;
        $zarpes->notification = $request->notification;
        $zarpes->finalityZarpe = $request->finalityZarpe;
        $zarpes->national = $request->national;
        $zarpes->id_municipalities = $request->id_region;
        $zarpes->id_docks = $request->id_port;
        $zarpes->id_portZarpe = $request->id_portZarpe;
        $zarpes->id_portArrival = $request->id_portArrival;
        $zarpes->id_flag = $request->id_flag;
        $zarpes->id_material = $request->id_material;
        $zarpes->id_nationality = $request->id_nationality;
        $zarpes->id_orop = $request->id_orop;
        $zarpes->id_zoneAutoFisher = $request->id_zoneAutoFisher;
        $zarpes->id_company = $request->id_company;
        $zarpes->autorization = 1;
        $zarpes->id_boat = $boats[0]->id;
        $zarpes->save();

        $array = array(
            'res' => true,
            'zarpe' => $zarpes->id,
            'message' => 'Registro guardado exitosamente'
        );

        $detailsfisheryzarpe = $request->data;

        foreach ($detailsfisheryzarpe as $fs => $deta) {
            $objeto = new DetailFisherAutZarpe();
            $objeto->id_fisheryAut = $zarpes->id;
            $objeto->name = $deta['name'];
            $objeto->save();
        }

        return response()->json($array, 201);
        // $array = array(
        //     'res' => true,
        //     'message' => 'Registro guardado exitosamente'
        //     );
        // return response()->json($array,201);
    }

    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $zarpes = Zarpe::findOrFail($request->id);

        $zarpes->insNo = $request->insNo;
        // $zarpes->portArrival = $request->portArrival;
        $zarpes->radioCall = $request->radioCall;
        $zarpes->idOmi = $request->idOmi;
        $zarpes->noResolution = $request->noResolution;
        $zarpes->nameBoat = $request->nameBoat;
        $zarpes->enrollment = $request->enrollment;
        $zarpes->noPatent = $request->noPatent;
        $zarpes->representative = $request->representative;
        // $zarpes->zoneAutoFish = $request->zoneAutoFish;
        $zarpes->eyeMesh = $request->eyeMesh;
        $zarpes->netWidth = $request->netWidth;
        $zarpes->eyeFlake = $request->eyeFlake;
        $zarpes->typeHook = $request->typeHook;
        $zarpes->longNet = $request->longNet;
        $zarpes->totalLongline = $request->totalLongline;
        $zarpes->other = $request->other;
        // $zarpes->materialArt = $request->materialArt;
        $zarpes->equipDevi = $request->equipDevi;
        $zarpes->captain = $request->captain;
        $zarpes->observation = $request->observation;
        $zarpes->observationGeneral = $request->observationGeneral;
        $zarpes->conclusions = $request->conclusions;
        $zarpes->comments = $request->comments;
        $zarpes->dateIns = $request->dateIns;
        $zarpes->dateZarpe = $request->dateZarpe;
        $zarpes->dateResolution = $request->dateResolution;
        $zarpes->dateValid = $request->dateValid;
        $zarpes->dateLatestArrival = $request->dateLatestArrival;
        $zarpes->dateValidityPat = $request->dateValidityPat;
        $zarpes->notification = $request->notification;
        $zarpes->finalityZarpe = $request->finalityZarpe;
        $zarpes->national = $request->national;
        $zarpes->autorization = $request->autorization;
        $zarpes->id_municipalities = $request->id_region; // Se cambio por id_region
        $zarpes->id_docks = $request->id_port; // Se cambio por id_port
        $zarpes->id_flag = $request->id_flag;
        $zarpes->id_material = $request->id_material;
        $zarpes->id_nationality = $request->id_nationality;
        $zarpes->id_orop = $request->id_orop;
        $zarpes->id_zoneAutoFisher = $request->id_zoneAutoFisher;
        // $zarpes->id_fisheryAuthorized = $request->id_fisheryAuthorized;
        $zarpes->id_company = $request->id_company;
        $zarpes->id_portZarpe = $request->id_portZarpe;
        $zarpes->id_portArrival = $request->id_portArrival;
        $zarpes->id_boat = $request->boatId;
        $detailsfisheryzarpe = $request->data;

        DetailFisherAutZarpe::where('id_fisheryAut', $zarpes->id)->delete();

        foreach ($detailsfisheryzarpe as $fs => $deta) {
            $objeto = new DetailFisherAutZarpe();
            $objeto->id_fisheryAut = $zarpes->id;
            $objeto->name = $deta['name'];
            $objeto->save();
        }

        $zarpes->save();

        $array = array(
            'res' => true,
            'message' => 'Registro actualizado exitosamente'
        );
        return response()->json($array, 201);
    }

    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $zarpes = Zarpe::findOrFail($request->id);
        $zarpes->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro se elimino exitosamente'
        );
        return response()->json($array, 201);
    }

    public function dataFishery(Request $request)
    {
        $zarpes = DetailFisherAutZarpe::select('id', 'id_fisheryAut', 'name')
            ->where('id_fisheryAut', $request->id_FisheryAut)->get();
        return ['fisheryAut' => $zarpes];
    }
}
