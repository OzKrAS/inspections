<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arrival;

class ArrivalController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $arrivals = Arrival::join('regions','arrivals.id_region','=','regions.id')
            ->join('ports','arrivals.id_port','=','ports.id')
            ->join('flags','arrivals.id_flag','=','flags.id')
            ->select('arrivals.id',
                     'arrivals.insNo',
                     'arrivals.portArrival',
                     'arrivals.radioCall',
                     'arrivals.idOmi',
                     'arrivals.noResolution',
                     'arrivals.nameBoat',
                     'arrivals.enrollment',
                     'arrivals.noPatent',
                     'arrivals.representative',
                     'arrivals.business',
                     'arrivals.zoneAutFish',
                     'arrivals.eyeMesh',
                     'arrivals.netWidth',
                     'arrivals.eyeFlake',
                     'arrivals.typeHook',
                     'arrivals.longNet',
                     'arrivals.materialArt',
                     'arrivals.equipDevi',
                     'arrivals.captain',
                     'arrivals.nacionality',
                     'arrivals.observation',
                     'arrivals.conclusions',
                     'arrivals.comments',
                     'arrivals.dateIns',
                     'arrivals.dateScale',
                     'arrivals.dateZarpe',
                     'arrivals.dateResolution',
                     'arrivals.dateValid',
                     'arrivals.dateLatestArrival',
                     'arrivals.dateValidityPat',
                     'arrivals.id_region','regions.name as nameReg',
                     'arrivals.id_port','ports.name as namePort',
                     'arrivals.id_flag','flags.name as nameFlag'
            )
        
            ->paginate(9999999999999999999999999);
        
        return [
            'arrivals' => $arrivals
        ];
    }   
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $arrivals = new Arrival(); 
        $arrivals->insNo = $request->insNo;
        $arrivals->portArrival = $request->portArrival;
        $arrivals->radioCall = $request->radioCall;
        $arrivals->idOmi = $request->idOmi;
        $arrivals->noResolution = $request->noResolution;
        $arrivals->nameBoat = $request->nameBoat;
        $arrivals->enrollment = $request->enrollment;
        $arrivals->noPatent = $request->noPatent;
        $arrivals->representative = $request->representative;
        $arrivals->business = $request->business;
        $arrivals->zoneAutFish = $request->zoneAutFish;
        $arrivals->eyeMesh = $request->eyeMesh;
        $arrivals->netWidth = $request->netWidth;
        $arrivals->eyeFlake = $request->eyeFlake;
        $arrivals->typeHook = $request->typeHook;
        $arrivals->longNet = $request->longNet;
        $arrivals->materialArt = $request->materialArt;
        $arrivals->equipDevi = $request->equipDevi;
        $arrivals->captain = $request->captain;
        $arrivals->nacionality = $request->nacionality; 
        $arrivals->observation = $request->observation;
        $arrivals->conclusions = $request->conclusions;
        $arrivals->comments = $request->comments;
        $arrivals->id_region = $request->id_region;    
        $arrivals->id_port = $request->id_port;    
        $arrivals->id_flag = $request->id_flag;    
        $arrivals->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $arrivals = Arrival::findOrFail($request->id);  
        $arrivals->insNo = $request->insNo;
        $arrivals->portArrival = $request->portArrival;
        $arrivals->radioCall = $request->radioCall;
        $arrivals->idOmi = $request->idOmi;
        $arrivals->noResolution = $request->noResolution;
        $arrivals->nameBoat = $request->nameBoat;
        $arrivals->enrollment = $request->enrollment;
        $arrivals->noPatent = $request->noPatent;
        $arrivals->representative = $request->representative;
        $arrivals->business = $request->business;
        $arrivals->zoneAutFish = $request->zoneAutFish;
        $arrivals->eyeMesh = $request->eyeMesh;
        $arrivals->netWidth = $request->netWidth;
        $arrivals->eyeFlake = $request->eyeFlake;
        $arrivals->typeHook = $request->typeHook;
        $arrivals->longNet = $request->longNet;
        $arrivals->materialArt = $request->materialArt;
        $arrivals->equipDevi = $request->equipDevi;
        $arrivals->captain = $request->captain;
        $arrivals->nacionality = $request->nacionality; 
        $arrivals->observation = $request->observation;
        $arrivals->conclusions = $request->conclusions;
        $arrivals->comments = $request->comments;
        $arrivals->id_region = $request->id_region;    
        $arrivals->id_port = $request->id_port;    
        $arrivals->id_flag = $request->id_flag;  
        $arrivals->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $arrivals = Arrival::findOrFail($request->id);
        $arrivals->delete();
    }
}
