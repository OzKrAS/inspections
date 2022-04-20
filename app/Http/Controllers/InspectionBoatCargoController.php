<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InspectionBoatCargo;
use App\Flag;
use App\Ports;

class InspectionBoatCargoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $inspections = InspectionBoatCargo::join('ports','inspection_boat_cargos.id_port','=','ports.id')
            ->join('flags','inspection_boat_cargos.id_flag','=','flags.id')
            ->select('inspection_boat_cargos.id',
                     'inspection_boat_cargos.place',
                     'inspection_boat_cargos.noForm',
                     'inspection_boat_cargos.businessColombia',
                     'inspection_boat_cargos.fullCargo',
                     'inspection_boat_cargos.nameBoatCargo',
                     'inspection_boat_cargos.nameBoat',
                     'inspection_boat_cargos.noIdOmi',
                     'inspection_boat_cargos.placeTransfer',
                     'inspection_boat_cargos.areasCapture',
                     'inspection_boat_cargos.species',
                     'inspection_boat_cargos.shapeProduct',
                     'inspection_boat_cargos.amount',
                     'inspection_boat_cargos.productLanded',
                     'inspection_boat_cargos.nameOfficial',
                     'inspection_boat_cargos.nameCaptain',
                     'inspection_boat_cargos.nameBusiness',
                     'inspection_boat_cargos.date',
                     'inspection_boat_cargos.dateTransfer',
                     'inspection_boat_cargos.notification',
                     'inspection_boat_cargos.areaOperation',
                     'inspection_boat_cargos.observation',
                     
                     'inspection_boat_cargos.id_port','ports.name as namePort',
                     'inspection_boat_cargos.id_flag','flags.name as nameFlag',
                     
            )
        
            ->paginate(9999999999999999999999999);

        return [     
            'inspections' => $inspections
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $inspections = new InspectionBoatCargo();
        $inspections->place = $request->place;
        $inspections->noForm = $request->noForm;
        $inspections->businessColombia = $request->businessColombia;
        $inspections->fullCargo = $request->fullCargo;
        $inspections->nameBoatCargo = $request->nameBoatCargo;
        $inspections->nameBoat = $request->nameBoat;
        $inspections->noIdOmi = $request->noIdOmi;
        $inspections->placeTransfer = $request->placeTransfer;
        $inspections->areasCapture = $request->areasCapture;
        $inspections->species = $request->species;
        $inspections->shapeProduct = $request->shapeProduct;
        $inspections->amount = $request->amount;
        $inspections->productLanded = $request->productLanded;
        $inspections->nameOfficial = $request->nameOfficial;
        $inspections->nameCaptain = $request->nameCaptain;
        $inspections->nameBusiness = $request->nameBusiness;
        $inspections->date = $request->date;
        $inspections->dateTransfer = $request->dateTransfer;
        $inspections->notification = $request->notification;
        $inspections->areaOperation = $request->areaOperation;
        $inspections->observation = $request->observation;
         
        $inspections->id_port = $request->id_port; 
        $inspections->id_portZarpe = $request->id_portZarpe;  
        $inspections->id_portDisemb = $request->id_portDisemb;     
        $inspections->id_flag = $request->id_flag;   
        $inspections->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $inspections = InspectionBoatCargo::findOrFail($request->id); 
        $inspections->place = $request->place;
        $inspections->noForm = $request->noForm;
        $inspections->businessColombia = $request->businessColombia;
        $inspections->fullCargo = $request->fullCargo;
        $inspections->nameBoatCargo = $request->nameBoatCargo;
        $inspections->nameBoat = $request->nameBoat;
        $inspections->noIdOmi = $request->noIdOmi;
        $inspections->placeTransfer = $request->placeTransfer;
        $inspections->areasCapture = $request->areasCapture;
        $inspections->species = $request->species;
        $inspections->shapeProduct = $request->shapeProduct;
        $inspections->amount = $request->amount;
        $inspections->productLanded = $request->productLanded;
        $inspections->nameOfficial = $request->nameOfficial;
        $inspections->nameCaptain = $request->nameCaptain;
        $inspections->nameBusiness = $request->nameBusiness;
        $inspections->date = $request->date;
        $inspections->dateTransfer = $request->dateTransfer;
        $inspections->notification = $request->notification;
        $inspections->areaOperation = $request->areaOperation;
        $inspections->observation = $request->observation;
        
        $inspections->id_port = $request->id_port;   
        $inspections->id_portZarpe = $request->id_portZarpe;  
        $inspections->id_portDisemb = $request->id_portDisemb;  
        $inspections->id_flag = $request->id_flag;   
        $inspections->save();
    }
    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $inspections = InspectionBoatCargo::findOrFail($request->id);
        $inspections->delete();
    }
}
