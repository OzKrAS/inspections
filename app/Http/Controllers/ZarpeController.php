<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zarpe;
use App\Region;
use App\Flag;

class ZarpeController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $zarpes = Zarpe::join('regions','zarpes.id_region','=','regions.id')
            ->select('zarpes.id', 'zarpes.name', 'zarpes.id_region','regions.name as nameReg')
            ->join('ports','zarpes.id_region','=','ports.id')
            ->select('zarpes.id', 'zarpes.name', 'zarpes.id_port','ports.name as namePort')
            ->join('flags','zarpes.id_flag','=','flags.id')
            ->select('zarpes.id', 'zarpes.name', 'zarpes.id_flag','flags.name as nameFlag')
            ->paginate(9999999999999999999999999);
        
        return [
            'zarpes' => $zarpes
        ];
    }   
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $zarpes = new Zarpe(); 
        $zarpes->insNo = $request->insNo;
        $zarpes->portArrival = $request->portArrival;
        $zarpes->radioCall = $request->radioCall;
        $zarpes->idOmi = $request->idOmi;
        $zarpes->noResolution = $request->noResolution;
        $zarpes->nameBoat = $request->nameBoat;
        $zarpes->enrollment = $request->enrollment;
        $zarpes->noPatent = $request->noPatent;
        $zarpes->representative = $request->representative;
        $zarpes->business = $request->business;
        $zarpes->zoneAutFish = $request->zoneAutFish;
        $zarpes->eyeMesh = $request->eyeMesh;
        $zarpes->netWidth = $request->netWidth;
        $zarpes->eyeFlake = $request->eyeFlake;
        $zarpes->typeHook = $request->typeHook;
        $zarpes->longNet = $request->longNet;
        $zarpes->materialArt = $request->materialArt;
        $zarpes->equipDevi = $request->equipDevi;
        $zarpes->captain = $request->captain;
        $zarpes->nacionality = $request->nacionality; 
        $zarpes->observation = $request->observation;
        $zarpes->conclusions = $request->conclusions;
        $zarpes->comments = $request->comments;
        $zarpes->id_region = $request->id_region;    
        $zarpes->id_port = $request->id_port;    
        $zarpes->id_flag = $request->id_flag;    
        $zarpes->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $zarpes = Zarpe::findOrFail($request->id);  
        $zarpes->insNo = $request->insNo;
        $zarpes->portArrival = $request->portArrival;
        $zarpes->radioCall = $request->radioCall;
        $zarpes->idOmi = $request->idOmi;
        $zarpes->noResolution = $request->noResolution;
        $zarpes->nameBoat = $request->nameBoat;
        $zarpes->enrollment = $request->enrollment;
        $zarpes->noPatent = $request->noPatent;
        $zarpes->representative = $request->representative;
        $zarpes->business = $request->business;
        $zarpes->zoneAutFish = $request->zoneAutFish;
        $zarpes->eyeMesh = $request->eyeMesh;
        $zarpes->netWidth = $request->netWidth;
        $zarpes->eyeFlake = $request->eyeFlake;
        $zarpes->typeHook = $request->typeHook;
        $zarpes->longNet = $request->longNet;
        $zarpes->materialArt = $request->materialArt;
        $zarpes->equipDevi = $request->equipDevi;
        $zarpes->captain = $request->captain;
        $zarpes->nacionality = $request->nacionality; 
        $zarpes->observation = $request->observation;
        $zarpes->conclusions = $request->conclusions;
        $zarpes->comments = $request->comments;
        $zarpes->id_region = $request->id_region;    
        $zarpes->id_port = $request->id_port;    
        $zarpes->id_flag = $request->id_flag;  
        $zarpes->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $zarpes = Zarpe::findOrFail($request->id);
        $zarpes->delete();
    }
}
