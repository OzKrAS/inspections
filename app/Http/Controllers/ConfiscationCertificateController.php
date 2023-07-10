<?php

namespace App\Http\Controllers;

use App\ConfiscationCertificate;
use App\DetConfiscationReasons;
use App\DetConfiscationTable1;
use App\DetConfiscationTable2;
use Illuminate\Http\Request;

class ConfiscationCertificateController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $confiscation = ConfiscationCertificate::join('regionals', 'confiscation_certificates.id_regional', '=', 'regionals.id')
            ->select('confiscation_certificates.id',
                'confiscation_certificates.noActa',
                'confiscation_certificates.departament',
                'confiscation_certificates.municipality',
                //  'confiscation_certificates.nameCommon',
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
                'confiscation_certificates.date',
                'confiscation_certificates.dateExpedition',
                'confiscation_certificates.observation',

                'confiscation_certificates.id_regional', 'regionals.name as nameRegional',
                     
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
        $confiscation->date = $request->date;
        $confiscation->dateExpedition = $request->dateExpedition;
        $confiscation->observation = $request->observation;

        $confiscation->id_regional = $request->id_regional;
        $confiscation->save();

        $details = $request->data;
        foreach ($details as $ep => $det) {
            $objeto = new DetConfiscationReasons();
            $objeto->id_confiscation = $confiscation->id;
            $objeto->name = $det['name'];
            $objeto->save();
        }
        $detailconfiscationt1 = $request->target;
        foreach ($detailconfiscationt1 as $ep => $det) {
            $objeto = new DetConfiscationTable1();
            $objeto->id_confiscation = $confiscation->id;
            $objeto->amount = $det['amount'];
            $objeto->average = $det['average'];
            $objeto->commercialValue = $det['commercialValue'];
            $objeto->nameCommon = $det['nameCommon'];
            $objeto->nameScientific = $det['nameScientific'];
            $objeto->presentation = $det['presentation'];
            $objeto->state = $det['state'];
            $objeto->weight = $det['weight'];

            $objeto->save();
        }
        $detaildonationt2 = $request->target2;
        foreach ($detaildonationt2 as $ep => $det) {
            $objeto = new DetConfiscationTable2();
            $objeto->id_confiscation = $confiscation->id;
            $objeto->amount2 = $det['amount2'];
            $objeto->characterState = $det['characterState'];
            $objeto->commercialValue2 = $det['commercialValue2'];
            $objeto->element = $det['element'];

            $objeto->save();
        }
        $array = array(
            'res' => true,
            'message' => 'Registro guardado exitosamente',
            'confiscation' => $confiscation
        );
        return response()->json($array, 201);
    }

    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $confiscation = ConfiscationCertificate::findOrFail($request->id);
        $confiscation->noActa = $request->noActa;
        $confiscation->departament = $request->departament;
        $confiscation->municipality = $request->municipality;
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
        $confiscation->date = $request->date;
        $confiscation->dateExpedition = $request->dateExpedition;
        $confiscation->observation = $request->observation;

        $confiscation->id_regional = $request->id_regional;
        $confiscation->save();

        $detailconfiscationt1 = $request->target;
        foreach ($detailconfiscationt1 as $ep => $det) {
            $objeto = new DetConfiscationTable1();
            $objeto->id_confiscation = $confiscation->id;
            $objeto->amount = $det['amount'];
            $objeto->average = $det['average'];
            $objeto->commercialValue = $det['commercialValue'];
            $objeto->nameCommon = $det['nameCommon'];
            $objeto->nameScientific = $det['nameScientific'];
            $objeto->presentation = $det['presentation'];
            $objeto->state = $det['state'];
            $objeto->weight = $det['weight'];

            $objeto->save();
        }
        $detaildonationt2 = $request->target2;
        foreach ($detaildonationt2 as $ep => $det) {
            $objeto = new DetConfiscationTable2();
            $objeto->id_confiscation = $confiscation->id;
            $objeto->amount2 = $det['amount2'];
            $objeto->characterState = $det['characterState'];
            $objeto->commercialValue2 = $det['commercialValue2'];
            $objeto->element = $det['element'];

            $objeto->save();
        }

        $array = array(
            'res' => true,
            'message' => 'Registro actualizado exitosamente'
        );
        return response()->json($array, 201);
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
        return response()->json($array, 201);
    }

    public function dataTable1(Request $request)
    {
        $confiscation = DetConfiscationTable1::select('id', 'id_confiscation', 'amount', 'average', 'commercialValue', 'nameCommon', 'nameScientific', 'presentation', 'state', 'weight')
            ->where('id_confiscation', $request->id_Confiscation)->get();
        return ['confTable1' => $confiscation];
    }

    public function dataTable2(Request $request)
    {
        $confiscation = DetConfiscationTable2::select('id', 'id_confiscation', 'amount2', 'characterState', 'commercialValue2', 'element')
            ->where('id_confiscation', $request->id_Confiscation)->get();
        return ['confTable2' => $confiscation];
    }

    public function dataReasons(Request $request)
    {
        $confiscation = DetConfiscationReasons::select('id', 'id_confiscation', 'name')
            ->where('id_confiscation', $request->id_Confiscation)->get();
        return ['reasons' => $confiscation];
    }
}
