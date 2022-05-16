<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfiscationCertificate;
use App\Regional;

class ConfiscationCertificateController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $confiscation = ConfiscationCertificate::join('regionals','confiscation_certificates.id_regional','=','regionals.id')
            ->select('confiscation_certificates.id',
                     'confiscation_certificates.noActa',
                     'confiscation_certificates.departament',
                     'confiscation_certificates.municipality',
                     'confiscation_certificates.nameScientific',
                     'confiscation_certificates.nameCommon',
                     'confiscation_certificates.amount',
                     'confiscation_certificates.average',
                     'confiscation_certificates.weight',
                     'confiscation_certificates.commercialValue',
                     'confiscation_certificates.element',
                     'confiscation_certificates.amount2',
                     'confiscation_certificates.featuresState',
                     'confiscation_certificates.commercialValue2',
                     'confiscation_certificates.text4',
                     'confiscation_certificates.officialName',
                     'confiscation_certificates.documentIdOfficial',
                     'confiscation_certificates.representativeName',
                     'confiscation_certificates.documentIdRepresentative',
                     'confiscation_certificates.plateCertificate',
                     'confiscation_certificates.name',
                     'confiscation_certificates.documentIdOffender',
                     'confiscation_certificates.expeditionPlace',
                     'confiscation_certificates.homeAddress',
                     'confiscation_certificates.municipalityOffender',
                     'confiscation_certificates.corregimiento',
                     'confiscation_certificates.neighborhood',
                     'confiscation_certificates.telephone',
                     'confiscation_certificates.mobile',
                     'confiscation_certificates.email',
                     'confiscation_certificates.state',
                     'confiscation_certificates.presentation',
                     'confiscation_certificates.date',
                     'confiscation_certificates.dateExpedition',
                     'confiscation_certificates.observation',
                                   
                     'confiscation_certificates.id_regional','regionals.name as nameRegional',
                     
            )
        
            ->paginate(9999999999999999999999999);

        return [     
            'confiscation' => $confiscation
        ];
    }
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $confiscation = new ConfiscationCertificate();
        $confiscation->noActa = $request->noActa;
        $confiscation->departament = $request->departament;
        $confiscation->municipality = $request->municipality;
        $confiscation->nameScientific = $request->nameScientific;
        $confiscation->nameCommon = $request->nameCommon;
        $confiscation->amount = $request->amount;
        $confiscation->average = $request->average;
        $confiscation->weight = $request->weight;
        $confiscation->commercialValue = $request->commercialValue;
        $confiscation->element = $request->element;
        $confiscation->amount2 = $request->amount2;
        $confiscation->featuresState = $request->featuresState;
        $confiscation->commercialValue2 = $request->commercialValue2;
        $confiscation->text4 = $request->text4;
        $confiscation->officialName = $request->officialName;
        $confiscation->documentIdOfficial = $request->documentIdOfficial;
        $confiscation->representativeName = $request->representativeName;
        $confiscation->documentIdRepresentative = $request->documentIdRepresentative;
        $confiscation->plateCertificate = $request->plateCertificate;
        $confiscation->name = $request->name;
        $confiscation->documentIdOffender = $request->documentIdOffender;
        $confiscation->expeditionPlace = $request->expeditionPlace;
        $confiscation->homeAddress = $request->homeAddress;
        $confiscation->municipalityOffender = $request->municipalityOffender;
        $confiscation->corregimiento = $request->corregimiento;
        $confiscation->neighborhood = $request->neighborhood;
        $confiscation->telephone = $request->telephone;
        $confiscation->mobile = $request->mobile;
        $confiscation->email = $request->email;
        $confiscation->state = $request->state;
        $confiscation->presentation = $request->presentation;
        $confiscation->date = $request->date;
        $confiscation->dateExpedition = $request->dateExpedition;
        $confiscation->observation = $request->observation;
        
        $confiscation->id_regional = $request->id_regional;  
        $confiscation->save();
        $array = array(
            'res' => true,
            'message' => 'Registro guardado exitosamente'
            );
        return response()->json($array,201);
    }
    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $confiscation = ConfiscationCertificate::findOrFail($request->id); 
        $confiscation->noActa = $request->noActa;
        $confiscation->departament = $request->departament;
        $confiscation->municipality = $request->municipality;
        $confiscation->nameScientific = $request->nameScientific;
        $confiscation->nameCommon = $request->nameCommon;
        $confiscation->amount = $request->amount;
        $confiscation->average = $request->average;
        $confiscation->weight = $request->weight;
        $confiscation->commercialValue = $request->commercialValue;
        $confiscation->element = $request->element;
        $confiscation->amount2 = $request->amount2;
        $confiscation->featuresState = $request->featuresState;
        $confiscation->commercialValue2 = $request->commercialValue2;
        $confiscation->text4 = $request->text4;
        $confiscation->officialName = $request->officialName;
        $confiscation->documentIdOfficial = $request->documentIdOfficial;
        $confiscation->representativeName = $request->representativeName;
        $confiscation->documentIdRepresentative = $request->documentIdRepresentative;
        $confiscation->plateCertificate = $request->plateCertificate;
        $confiscation->name = $request->name;
        $confiscation->documentIdOffender = $request->documentIdOffender;
        $confiscation->expeditionPlace = $request->expeditionPlace;
        $confiscation->homeAddress = $request->homeAddress;
        $confiscation->municipalityOffender = $request->municipalityOffender;
        $confiscation->corregimiento = $request->corregimiento;
        $confiscation->neighborhood = $request->neighborhood;
        $confiscation->telephone = $request->telephone;
        $confiscation->mobile = $request->mobile;
        $confiscation->email = $request->email;
        $confiscation->state = $request->state;
        $confiscation->presentation = $request->presentation;
        $confiscation->date = $request->date;
        $confiscation->dateExpedition = $request->dateExpedition;
        $confiscation->observation = $request->observation;
        
        $confiscation->id_regional = $request->id_regional;  
        $confiscation->save();
        $array = array(
            'res' => true,
            'message' => 'Registro actualizado exitosamente'
            );
        return response()->json($array,201);
    }
    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $confiscation = ConfiscationCertificate::findOrFail($request->id);
        $confiscation->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
            );
        return response()->json($array,201);
    }
}
