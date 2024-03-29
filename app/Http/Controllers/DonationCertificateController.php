<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;
use App\DonationCertificate;
use App\Regional;
use App\DetDonation;

class DonationCertificateController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index(Request $request)
    {
        //  if (!$request->ajax()) return redirect('/');

        if( auth()->user()->idrol == 1){
            $donations = DonationCertificate::join('regionals', 'donation_certificates.id_regional', '=', 'regionals.id')
            ->select('donation_certificates.id',
                'donation_certificates.noActa',
                'donation_certificates.date',
                'donation_certificates.nameOfficial',
                'donation_certificates.noDocumentId1',
                'donation_certificates.nameRepresentative',
                'donation_certificates.noDocumentId2',
                'donation_certificates.noPlateCertificate',
                'donation_certificates.name',
                'donation_certificates.legalStatus',
                'donation_certificates.address',
                'donation_certificates.representativeDonation',
                'donation_certificates.identification',
                'donation_certificates.municipality',
                'donation_certificates.corregimiento',
                'donation_certificates.place',
                'donation_certificates.telephone',

                'donation_certificates.id_regional', 'regionals.name as nameRegional',
                     
            )
            ->paginate(9999999999999999999999999);
        }
        else {
            $donations = DonationCertificate::join('regionals', 'donation_certificates.id_regional', '=', 'regionals.id')
            ->select('donation_certificates.id',
                'donation_certificates.noActa',
                'donation_certificates.date',
                'donation_certificates.nameOfficial',
                'donation_certificates.noDocumentId1',
                'donation_certificates.nameRepresentative',
                'donation_certificates.noDocumentId2',
                'donation_certificates.noPlateCertificate',
                'donation_certificates.name',
                'donation_certificates.legalStatus',
                'donation_certificates.address',
                'donation_certificates.representativeDonation',
                'donation_certificates.identification',
                'donation_certificates.municipality',
                'donation_certificates.corregimiento',
                'donation_certificates.place',
                'donation_certificates.telephone',

                'donation_certificates.id_regional', 'regionals.name as nameRegional',
                     
            )
            ->where('donation_certificates.user_id', '=', auth()->user()->id)
            ->paginate(9999999999999999999999999);
        }

        $arrayTarget = [];

        foreach ($donations as $value) {
            $arrayTarget[] = DetDonation::select('id', 'id_donation', 'nameScientific', 'nameCommon', 'state', 'presentation', 'amount', 'weight', 'commercialValue')
            ->where('id_donation', $value['id'])
            ->get();
        }

        return [
            'arrayTargets' => $arrayTarget,
            'donations' => $donations
        ];
    }

    /**
     * @throws \Exception
     */
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $donations = new DonationCertificate();
        $donations->user_id = $request->user_id;
        $donations->noActa = $request->noActa;
        $donations->date = $request->date;
        $donations->nameOfficial = $request->nameOfficial;
        $donations->noDocumentId1 = $request->noDocumentId1;
        $donations->nameRepresentative = $request->nameRepresentative;
        $donations->noDocumentId2 = $request->noDocumentId2;
        $donations->noPlateCertificate = $request->noPlateCertificate;
        $donations->name = $request->name;
        $donations->legalStatus = $request->legalStatus;
        $donations->address = $request->address;
        $donations->representativeDonation = $request->representativeDonation;
        $donations->identification = $request->identification;
        $donations->municipality = $request->municipality;
        $donations->corregimiento = $request->corregimiento;
        $donations->place = $request->place;
        $donations->telephone = $request->telephone;
        // $donations->img1 = $request->img1;

        $donations->id_regional = $request->id_regional;
        $donations->save();

        $detaildonation = $request->target;
        
        $array_ids = [];

        foreach ($detaildonation as $ep => $det) {
            $objeto = new DetDonation();
            $objeto->id_donation = $donations->id;
            $objeto->nameScientific = $det['nameScientific'];
            $objeto->nameCommon = $det['nameCommon'];
            $objeto->state = $det['state'];
            $objeto->presentation = $det['presentation'];
            $objeto->amount = $det['amount'];
            $objeto->weight = $det['weight'];
            $objeto->commercialValue = $det['commercialValue'];
            $objeto->save();

            if( isset($det['files']) ) {
                $class = class_basename(DetDonation::class);
                $this->fileService->massStoreBase64Files($det['files'], "App\\{$class}", $objeto->id);
            };

            array_push($array_ids,$objeto->id);
        }

        $array = array(
            'res' => true,
            'id' => $array_ids,
            'message' => 'Registro guardado exitosamente',
        );
        return response()->json($array, 201);
    }

    /**
     * @throws \Exception
     */
    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $donations = DonationCertificate::findOrFail($request->id);
        $donations->noActa = $request->noActa;
        $donations->date = $request->date;
        $donations->nameOfficial = $request->nameOfficial;
        $donations->noDocumentId1 = $request->noDocumentId1;
        $donations->nameRepresentative = $request->nameRepresentative;
        $donations->noDocumentId2 = $request->noDocumentId2;
        $donations->noPlateCertificate = $request->noPlateCertificate;
        $donations->name = $request->name;
        $donations->legalStatus = $request->legalStatus;
        $donations->address = $request->address;
        $donations->representativeDonation = $request->representativeDonation;
        $donations->identification = $request->identification;
        $donations->municipality = $request->municipality;
        $donations->corregimiento = $request->corregimiento;
        $donations->place = $request->place;
        $donations->telephone = $request->telephone;

        $donations->id_regional = $request->id_regional;
        $donations->save();

        $detaildonation = $request->target;
        foreach ($detaildonation as $ep => $det) {
            if(!isset($det['id'])){
                $objeto = new DetDonation();
                $objeto->id_donation = $donations->id;
                $objeto->nameScientific = $det['nameScientific'];
                $objeto->nameCommon = $det['nameCommon'];
                $objeto->state = $det['state'];
                $objeto->presentation = $det['presentation'];
                $objeto->amount = $det['amount'];
                $objeto->weight = $det['weight'];
                $objeto->commercialValue = $det['commercialValue'];

                $objeto->save();

                if( isset($det['files']) ) {
                    $class = class_basename(DetDonation::class);
                    $this->fileService->massStoreBase64Files($det['files'], "App\\{$class}", $objeto->id);
                };
            }else{
                $objeto = DetDonation::findOrFail($det['id']);
                if($det['deleted']){
                    $objeto->delete();;
                }else{
                    $objeto->nameScientific = $det['nameScientific'];
                    $objeto->nameCommon = $det['nameCommon'];
                    $objeto->state = $det['state'];
                    $objeto->presentation = $det['presentation'];
                    $objeto->amount = $det['amount'];
                    $objeto->weight = $det['weight'];
                    $objeto->commercialValue = $det['commercialValue'];
                    $objeto->save();
                }
            }
        }

        $array = array(
            'res' => true,
            'id' => $request->id,
            'message' => 'Registro actualizado exitosamente'
        );
        return response()->json($array, 201);
    }

    public function destroy(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $donations = DonationCertificate::findOrFail($request->id);
        $donations->delete();
        $array = array(
            'res' => true,
            'message' => 'Registro eliminado exitosamente'
        );
        return response()->json($array, 201);
    }

    public function dataTable(Request $request)
    {
        $donations = DetDonation::select('id', 'id_donation', 'nameScientific', 'nameCommon', 'state', 'presentation', 'amount', 'weight', 'commercialValue')
            ->where('id_donation', $request->id_Donation)
            ->with('files')
            ->get();
        return ['donation' => $donations];
    }
}
