<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InspectionBoatCargo;
use App\Flag;
use App\Ports;
use App\DetailInspectionBoat;

class InspectionBoatCargoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        //        ->selectRaw("CONCAT(ports.name, ' - ', docks.name) as nameDock,docks.id, docks.name,docks.arrival,docks.zarpe,docks.id_port,
        // ports.name as namePort")
        $inspections = InspectionBoatCargo::join('flags','inspection_boat_cargos.id_flag','=','flags.id')
            ->join('docks','inspection_boat_cargos.id_port','=','docks.id')
            ->join('docks as d','inspection_boat_cargos.id_portZarpe','=','d.id')
            ->join('docks as dd','inspection_boat_cargos.id_portDisemb','=','dd.id')
            ->join('ports','docks.id_port','=','ports.id')
            ->selectRaw("CONCAT(ports.name, ' - ', docks.name) as portTrans,CONCAT(ports.name, ' - ', d.name) as portZarpe,CONCAT(ports.name, ' - ', d.name) as portZarpe,CONCAT(ports.name, ' - ', dd.name) as portDisemb,inspection_boat_cargos.id,
                     inspection_boat_cargos.place,
                     inspection_boat_cargos.noForm,
                     inspection_boat_cargos.businessColombia,
                     inspection_boat_cargos.fullCargo,
                     inspection_boat_cargos.nameBoatCargo,
                     inspection_boat_cargos.nameBoat,
                     inspection_boat_cargos.noIdOmi,
                     inspection_boat_cargos.placeTransfer,
                     inspection_boat_cargos.areasCapture,
                     inspection_boat_cargos.shapeProduct,
                     inspection_boat_cargos.amount,
                     inspection_boat_cargos.nameOfficial,
                     inspection_boat_cargos.nameCaptain,
                     inspection_boat_cargos.nameBusiness,
                     inspection_boat_cargos.date,
                     inspection_boat_cargos.dateTransfer,
                     inspection_boat_cargos.notification,
                     inspection_boat_cargos.observation,
                     inspection_boat_cargos.areaOperation,                     
                     inspection_boat_cargos.id_port,
                     inspection_boat_cargos.id_portZarpe,
                     inspection_boat_cargos.id_portDisemb,
                     inspection_boat_cargos.id_flag,inspection_boat_cargos.id_flagDonor,flags.name as nameFlag",
                     
            )

            ->paginate(999999);

        return [
            'inspections' => $inspections
        ];
    }
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $inspections = new InspectionBoatCargo();
        $inspections->user_id = $request->user_id;

        $inspections->place = $request->place;
        $inspections->noForm = $request->noForm;
        $inspections->businessColombia = $request->businessColombia;
        $inspections->fullCargo = $request->fullCargo;
        $inspections->nameBoatCargo = $request->nameBoatCargo;
        $inspections->nameBoat = $request->nameBoat;
        $inspections->noIdOmi = $request->noIdOmi;
        $inspections->placeTransfer = $request->placeTransfer;
        $inspections->areasCapture = $request->areasCapture;
        $inspections->shapeProduct = $request->shapeProduct;
        $inspections->amount = $request->amount;
        $inspections->nameOfficial = $request->nameOfficial;
        $inspections->nameCaptain = $request->nameCaptain;
        $inspections->nameBusiness = $request->nameBusiness;
        $inspections->date = $request->date;
        $inspections->dateTransfer = $request->dateTransfer;
        $inspections->notification = $request->notification;
        $inspections->areaOperation = $request->areaOperation;
        $inspections->observation = $request->observation;
        $inspections->another = $request->another;

        $inspections->id_port = $request->id_port;
        $inspections->id_portZarpe = $request->id_portZarpe;
        $inspections->id_portDisemb = $request->id_portDisemb;
        $inspections->id_flag = $request->id_flag;
        $inspections->id_flagDonor = $request->id_flagDonor;
        $inspections->save();

        $detailinspection = $request->data;
        foreach($detailinspection as $ep=>$det){
            $objeto= new DetailInspectionBoat();
            $objeto->id_inspection = $inspections->id;
            $objeto->nameCommon1= $det['nameCommon1'];
            $objeto->nameScientific1= $det['nameScientific1'];
            $objeto->nameBoat= $det['nameBoat'];
            $objeto->flag= $det['id_flag'];
            $objeto->noIdOmi= $det['noIdOmi'];
            $objeto->placeTransfer= $det['placeTransfer'];
            $objeto->dateTransfer= $det['dateTransfer'];
            $objeto->areasCapture= $det['areasCapture'];
            $objeto->shapeProduct= $det['shapeProduct'];
            $objeto->amount= $det['amount'];
            $objeto->save();
        }

        $array = array(
            'res' => true,
            'message' => 'Registro guardado exitosamente',
            'inspection' => $inspections
        );

        return response()->json($array,201);
    }
    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
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
        $inspections->shapeProduct = $request->shapeProduct;
        $inspections->amount = $request->amount;
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
        $inspections->id_flagDonor = $request->id_flagDonor;
        $inspections->save();

        $detailinspection = $request->data;
        foreach($detailinspection as $ep=>$det){
            $objeto= new DetailInspectionBoat();
            $objeto->id_inspection = $inspections->id;
            $objeto->nameCommon1= $det['nameCommon1'];
            $objeto->nameScientific1= $det['nameScientific1'];
            $objeto->nameBoat= $det['nameBoat'];
            $objeto->flag= $det['id_flag'];
            $objeto->noIdOmi= $det['noIdOmi'];
            $objeto->placeTransfer= $det['placeTransfer'];
            $objeto->dateTransfer= $det['dateTransfer'];
            $objeto->areasCapture= $det['areasCapture'];
            $objeto->shapeProduct= $det['shapeProduct'];
            $objeto->amount= $det['amount'];
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
        $inspections = InspectionBoatCargo::findOrFail($request->id);
        $inspections->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
        );
        return response()->json($array,201);
    }
}
