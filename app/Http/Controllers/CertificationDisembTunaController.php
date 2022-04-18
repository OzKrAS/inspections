<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CertificationDisembTuna;
use App\Port;
use App\Flag;
use App\Company;

class CertificationDisembTunaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $tunas = CertificationDisembTuna::join('companies','certification_disemb_tunas.id_company','=','companies.id') 
            ->join('ports','certification_disemb_tunas.id_port','=','ports.id') 
            ->join('flags','certification_disemb_tunas.id_flag','=','flags.id') 
            ->select('certification_disemb_tunas.id',
                     'certification_disemb_tunas.nameBoat',
                     'certification_disemb_tunas.ZoneFisher',
                     'certification_disemb_tunas.voBo',
                     'certification_disemb_tunas.nameOfficial', 
                     'certification_disemb_tunas.yellowFin', 
                     'certification_disemb_tunas.barrilete', 
                     'certification_disemb_tunas.patudo', 
                     'certification_disemb_tunas.date',
                     'certification_disemb_tunas.dateBeginningFaena',
                     'certification_disemb_tunas.dateEndFaena',
                     'certification_disemb_tunas.observation',
                     'certification_disemb_tunas.other',
                     'certification_disemb_tunas.poundRating1',
                     'certification_disemb_tunas.poundRating2',
                     'certification_disemb_tunas.poundRating3',
                     'certification_disemb_tunas.poundRating4',
                                    
                     'certification_disemb_tunas.id_company','companies.name as nameCompany',
                     'certification_disemb_tunas.id_port','ports.name as namePort',
                     'certification_disemb_tunas.id_flag','flags.name as nameFlag',
                     
            )
        
            ->paginate(9999999999999999999999999);

        return [     
            'tunas' => $tunas
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tunas = new CertificationDisembTuna();
        $tunas->nameBoat = $request->nameBoat;
        $tunas->ZoneFisher = $request->ZoneFisher;
        $tunas->voBo = $request->voBo;
        $tunas->nameOfficial = $request->nameOfficial; 
        $tunas->yellowFin = $request->yellowFin; 
        $tunas->barrilete = $request->barrilete; 
        $tunas->patudo = $request->patudo; 
        $tunas->date = $request->date;
        $tunas->dateBeginningFaena = $request->dateBeginningFaena;
        $tunas->dateEndFaena = $request->dateEndFaena;
        $tunas->observation = $request->observation;
        $tunas->other = $request->other;
        $tunas->poundRating1 = $request->poundRating1;
        $tunas->poundRating2 = $request->poundRating2;
        $tunas->poundRating3 = $request->poundRating3;
        $tunas->poundRating4 = $request->poundRating4;
        
        $tunas->id_company = $request->id_company;  
        $tunas->id_port = $request->id_port;  
        $tunas->id_flag = $request->id_flag;  
        $tunas->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tunas = CertificationDisembTuna::findOrFail($request->id); 
        $tunas->nameBoat = $request->nameBoat;
        $tunas->ZoneFisher = $request->ZoneFisher;
        $tunas->voBo = $request->voBo;
        $tunas->nameOfficial = $request->nameOfficial; 
        $tunas->yellowFin = $request->yellowFin; 
        $tunas->barrilete = $request->barrilete; 
        $tunas->patudo = $request->patudo; 
        $tunas->date = $request->date;
        $tunas->dateBeginningFaena = $request->dateBeginningFaena;
        $tunas->dateEndFaena = $request->dateEndFaena;
        $tunas->observation = $request->observation;
        $tunas->other = $request->other;
        $tunas->poundRating1 = $request->poundRating1;
        $tunas->poundRating2 = $request->poundRating2;
        $tunas->poundRating3 = $request->poundRating3;
        $tunas->poundRating4 = $request->poundRating4;
         
        $tunas->id_company = $request->id_company;  
        $tunas->id_port = $request->id_port;  
        $tunas->id_flag = $request->id_flag;   
        $tunas->save();
    }
    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tunas = CertificationDisembTuna::findOrFail($request->id);
        $tunas->delete();
    }
}
