<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CertificationDisembTuna;
use App\Port;
use App\Flag;
use App\Company;
use App\DetailDisembTuna;

class CertificationDisembTunaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        if( auth()->user()->idrol == 1 ){
            $tunas = CertificationDisembTuna::join('companies','certification_disemb_tunas.id_company','=','companies.id') 
            ->join('ports','certification_disemb_tunas.id_port','=','ports.id') 
            ->join('flags','certification_disemb_tunas.id_flag','=','flags.id') 
            ->select('certification_disemb_tunas.id',
                     'certification_disemb_tunas.nameBoat',
                     'certification_disemb_tunas.ZoneFisher',
                     'certification_disemb_tunas.date',
                     'certification_disemb_tunas.dateBeginningFaena',
                     'certification_disemb_tunas.dateEndFaena',
                     'certification_disemb_tunas.observation',
                                    
                     'certification_disemb_tunas.id_company','companies.name as nameCompany',
                     'certification_disemb_tunas.id_port','ports.name as namePort',
                     'certification_disemb_tunas.id_flag','flags.name as nameFlag',
                     
            )
            ->paginate(99999999);
        }
        else {
            $tunas = CertificationDisembTuna::join('companies','certification_disemb_tunas.id_company','=','companies.id') 
            ->join('ports','certification_disemb_tunas.id_port','=','ports.id') 
            ->join('flags','certification_disemb_tunas.id_flag','=','flags.id') 
            ->select('certification_disemb_tunas.id',
                     'certification_disemb_tunas.nameBoat',
                     'certification_disemb_tunas.ZoneFisher',
                     'certification_disemb_tunas.date',
                     'certification_disemb_tunas.dateBeginningFaena',
                     'certification_disemb_tunas.dateEndFaena',
                     'certification_disemb_tunas.observation',
                                    
                     'certification_disemb_tunas.id_company','companies.name as nameCompany',
                     'certification_disemb_tunas.id_port','ports.name as namePort',
                     'certification_disemb_tunas.id_flag','flags.name as nameFlag',
                     
            )
            ->where('certification_disemb_tunas.user_id', '=', auth()->user()->id)
            ->paginate(99999999);
        }

        return [     
            'tunas' => $tunas
        ];
    }
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $tunas = new CertificationDisembTuna();
        $tunas->user_id = auth()->user()->id;
        $tunas->nameBoat = $request->nameBoat;
        $tunas->ZoneFisher = $request->ZoneFisher;
        $tunas->date = $request->date;
        $tunas->dateBeginningFaena = $request->dateBeginningFaena;
        $tunas->dateEndFaena = $request->dateEndFaena;
        $tunas->observation = $request->observation;
        $tunas->other = $request->other;
        
        $tunas->id_company = $request->id_company;  
        $tunas->id_port = $request->id_port;  
        $tunas->id_flag = $request->id_flag;  
        $tunas->save();

        $detaildisembtuna = $request->target;
        foreach($detaildisembtuna as $ep=>$det){
            $objeto= new DetailDisembTuna();
            $objeto->id_disembTuna = $tunas->id;
            $objeto->poundRating = $det['poundRating'];
            $objeto->yellowFin = $det['yellowFin'];
            $objeto->barrilete = $det['barrilete'];
            $objeto->patudo = $det['patudo'];
            $objeto->other = $det['other'];

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
        $tunas = CertificationDisembTuna::findOrFail($request->id); 
        $tunas->nameBoat = $request->nameBoat;
        $tunas->ZoneFisher = $request->ZoneFisher;
        $tunas->date = $request->date;
        $tunas->dateBeginningFaena = $request->dateBeginningFaena;
        $tunas->dateEndFaena = $request->dateEndFaena;
        $tunas->observation = $request->observation;
         
        $tunas->id_company = $request->id_company;  
        $tunas->id_port = $request->id_port;  
        $tunas->id_flag = $request->id_flag;   
        $tunas->save();
        $array = array(
            'res' => true,
            'message' => 'Registro actualizado exitosamente'
            );
        return response()->json($array,201);
    }
    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $tunas = CertificationDisembTuna::findOrFail($request->id);
        $tunas->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
            );
        return response()->json($array,201);
    }
    public function dataTable1(Request $request)
    {
        $tunas = DetailDisembTuna::select('id','id_disembTuna','poundRating','yellowFin','barrilete','patudo','other')
        ->where('id_disembTuna', $request->id_DisembTuna)->get();
        return ['confTable1' =>  $tunas];   
    }
}
