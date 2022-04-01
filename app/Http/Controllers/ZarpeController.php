<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zarpe;
use App\Region;
use App\Flag;
use App\Nationality;

class ZarpeController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $zarpes = Zarpe::join('regions','zarpes.id_region','=','regions.id')
            ->join('ports','zarpes.id_port','=','ports.id')
            ->join('flags','zarpes.id_flag','=','flags.id')
            ->join('nationalities','zarpes.id_nationality','=','nationalities.id')
            ->select('zarpes.id',
                     'zarpes.insNo',
                     'zarpes.portArrival',
                     'zarpes.radioCall',
                     'zarpes.idOmi',
                     'zarpes.noResolution',
                     'zarpes.nameBoat',
                     'zarpes.enrollment',
                     'zarpes.noPatent',
                     'zarpes.representative',
                     'zarpes.business',
                     'zarpes.zoneAutFish',
                     'zarpes.eyeMesh',
                     'zarpes.netWidth',
                     'zarpes.eyeFlake',
                     'zarpes.typeHook',
                     'zarpes.longNet',
                     'zarpes.materialArt',
                     'zarpes.equipDevi',
                     'zarpes.captain',
                     'zarpes.observation',
                     'zarpes.conclusions',
                     'zarpes.comments',
                     'zarpes.dateIns',
                     'zarpes.dateScale',
                     'zarpes.dateZarpe',
                     'zarpes.dateResolution',
                     'zarpes.dateValid',
                     'zarpes.dateLatestArrival',
                     'zarpes.dateValidityPat',

                     'zarpes.notification',
                     'zarpes.finalityZarpe',
                     'zarpes.origin',
                     'zarpes.destination',
                     'zarpes.national',
                     'zarpes.orop',
                     'zarpes.fishAut',

                     'zarpes.id_region','regions.name as nameReg',
                     'zarpes.id_port','ports.name as namePort',
                     'zarpes.id_flag','flags.name as nameFlag',
                     'zarpes.id_nationality','nationalities.name as nameNationality',
                     
            )
        
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
        $zarpes->observation = $request->observation;
        $zarpes->conclusions = $request->conclusions;
        $zarpes->comments = $request->comments;
        $zarpes->dateIns = $request->dateIns;
        $zarpes->dateScale = $request->dateScale;
        $zarpes->dateZarpe = $request->dateZarpe;
        $zarpes->dateResolution = $request->dateResolution;
        $zarpes->dateValid = $request->dateValid;
        $zarpes->dateLatestArrival = $request->dateLatestArrival;
        $zarpes->dateValidityPat = $request->dateValidityPat;

        $zarpes->notification = $request->notification;
        $zarpes->finalityZarpe = $request->finalityZarpe;
        $zarpes->origin = $request->origin;
        $zarpes->destination = $request->destination;
        $zarpes->national = $request->national;
        $zarpes->orop = $request->orop;
        $zarpes->fishAut = $request->fishAut;

        $zarpes->id_region = $request->id_region;    
        $zarpes->id_port = $request->id_port;    
        $zarpes->id_flag = $request->id_flag;   
        $zarpes->id_nationality = $request->id_nationality;       
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
        $zarpes->observation = $request->observation;
        $zarpes->conclusions = $request->conclusions;
        $zarpes->comments = $request->comments;

        $zarpes->dateIns = $request->dateIns;
        $zarpes->dateScale = $request->dateScale;
        $zarpes->dateZarpe = $request->dateZarpe;
        $zarpes->dateResolution = $request->dateResolution;
        $zarpes->dateValid = $request->dateValid;
        $zarpes->dateLatestArrival = $request->dateLatestArrival;
        $zarpes->dateValidityPat = $request->dateValidityPat;

        $zarpes->notification = $request->notification;
        $zarpes->finalityZarpe = $request->finalityZarpe;
        $zarpes->origin = $request->origin;
        $zarpes->destination = $request->destination;
        $zarpes->national = $request->national;
        $zarpes->orop = $request->orop;
        $zarpes->fishAut = $request->fishAut;

        $zarpes->id_region = $request->id_region;    
        $zarpes->id_port = $request->id_port;    
        $zarpes->id_flag = $request->id_flag;  
        $zarpes->id_nationality = $request->id_nationality;  
        $zarpes->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $zarpes = Zarpe::findOrFail($request->id);
        $zarpes->delete();
    }
}
