<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NoticePreviousZarpe;
use App\Ports;
use App\Nationality;

class NoticePreviousZarpeController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $noticezarpes = NoticePreviousZarpe::join('ports','notice_previous_zarpes.id_port','=','ports.id')
            ->join('nationalities','notice_previous_zarpes.id_nationality','=','nationalities.id')
            ->select('notice_previous_zarpes.id',
                    'notice_previous_zarpes.time',
                    'notice_previous_zarpes.portState',
                    'notice_previous_zarpes.nameBoat', 
                    'notice_previous_zarpes.statePavilion', 
                    'notice_previous_zarpes.internationalSignal',
                    'notice_previous_zarpes.informationBoat', 
                    'notice_previous_zarpes.ownerBoat', 
                    'notice_previous_zarpes.idEnrollment', 
                    'notice_previous_zarpes.idOmi', 
                    'notice_previous_zarpes.idExternal', 
                    'notice_previous_zarpes.idOrop', 
                    'notice_previous_zarpes.type', 
                    'notice_previous_zarpes.lengthBoat', 
                    'notice_previous_zarpes.sleeveBoat', 
                    'notice_previous_zarpes.draftBoat', 
                    'notice_previous_zarpes.nameCaptain', 
                    'notice_previous_zarpes.noIdentification', 
                    'notice_previous_zarpes.identifier', 
                    'notice_previous_zarpes.fishingAreas', 
                    'notice_previous_zarpes.species', 
                    'notice_previous_zarpes.arts', 
                    'notice_previous_zarpes.typeFishery',
                    'notice_previous_zarpes.date',
                    'notice_previous_zarpes.datePlanned',
                    'notice_previous_zarpes.typeBoat',
                    'notice_previous_zarpes.slbVms',
                    'notice_previous_zarpes.dateExp',
                    'notice_previous_zarpes.dateExpiration',
                                   
                    'notice_previous_zarpes.id_port','ports.name as namePort',
                    'notice_previous_zarpes.id_nationality','nationalities.name as nameNationality',
                     
            )
        
            ->paginate(9999999999999999999999999);

        return [     
            'noticezarpes' => $noticezarpes
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $noticezarpes = new NoticePreviousZarpe();

        $noticezarpes->time = $request->time;
        $noticezarpes->portState = $request->portState;
        $noticezarpes->nameBoat = $request->nameBoat; 
        $noticezarpes->statePavilion = $request->statePavilion; 
        $noticezarpes->internationalSignal = $request->internationalSignal;
        $noticezarpes->informationBoat = $request->informationBoat; 
        $noticezarpes->ownerBoat = $request->ownerBoat; 
        $noticezarpes->idEnrollment = $request->idEnrollment; 
        $noticezarpes->idOmi = $request->idOmi; 
        $noticezarpes->idExternal = $request->idExternal; 
        $noticezarpes->idOrop = $request->idOrop; 
        $noticezarpes->type = $request->type; 
        $noticezarpes->lengthBoat = $request->lengthBoat; 
        $noticezarpes->sleeveBoat = $request->sleeveBoat; 
        $noticezarpes->draftBoat = $request->draftBoat; 
        $noticezarpes->nameCaptain = $request->nameCaptain; 
        $noticezarpes->noIdentification = $request->noIdentification; 
        $noticezarpes->identifier = $request->identifier; 
        $noticezarpes->fishingAreas = $request->fishingAreas; 
        $noticezarpes->species = $request->species; 
        $noticezarpes->arts = $request->arts; 
        $noticezarpes->typeFishery = $request->typeFishery;
        $noticezarpes->date = $request->date;
        $noticezarpes->datePlanned = $request->datePlanned;
        $noticezarpes->typeBoat = $request->typeBoat;
        $noticezarpes->slbVms = $request->slbVms;
        $noticezarpes->dateExp = $request->dateExp;
        $noticezarpes->dateExpiration = $request->dateExpiration;
       
        $noticezarpes->id_port = $request->id_port;  
        $noticezarpes->id_port_scale = $request->id_port_scale;
        $noticezarpes->id_nationality = $request->id_nationality;
        $noticezarpes->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $noticezarpes = NoticePreviousZarpe::findOrFail($request->id); 
        $noticezarpes->time = $request->time;
        $noticezarpes->portState = $request->portState;
        $noticezarpes->nameBoat = $request->nameBoat; 
        $noticezarpes->statePavilion = $request->statePavilion; 
        $noticezarpes->internationalSignal = $request->internationalSignal;
        $noticezarpes->informationBoat = $request->informationBoat; 
        $noticezarpes->ownerBoat = $request->ownerBoat; 
        $noticezarpes->idEnrollment = $request->idEnrollment; 
        $noticezarpes->idOmi = $request->idOmi; 
        $noticezarpes->idExternal = $request->idExternal; 
        $noticezarpes->idOrop = $request->idOrop; 
        $noticezarpes->type = $request->type; 
        $noticezarpes->lengthBoat = $request->lengthBoat; 
        $noticezarpes->sleeveBoat = $request->sleeveBoat; 
        $noticezarpes->draftBoat = $request->draftBoat; 
        $noticezarpes->nameCaptain = $request->nameCaptain; 
        $noticezarpes->noIdentification = $request->noIdentification; 
        $noticezarpes->identifier = $request->identifier; 
        $noticezarpes->fishingAreas = $request->fishingAreas; 
        $noticezarpes->species = $request->species; 
        $noticezarpes->arts = $request->arts; 
        $noticezarpes->typeFishery = $request->typeFishery;
        $noticezarpes->date = $request->date;
        $noticezarpes->datePlanned = $request->datePlanned;
        $noticezarpes->typeBoat = $request->typeBoat;
        $noticezarpes->slbVms = $request->slbVms;
        $noticezarpes->dateExp = $request->dateExp;
        $noticezarpes->dateExpiration = $request->dateExpiration;
       
        $noticezarpes->id_port = $request->id_port;  
        $noticezarpes->id_port_scale = $request->id_port_scale;
        $noticezarpes->id_nationality = $request->id_nationality;
        $noticezarpes->save();
    }
    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $noticezarpes = NoticePreviousZarpe::findOrFail($request->id);
        $noticezarpes->delete();
    }
}
