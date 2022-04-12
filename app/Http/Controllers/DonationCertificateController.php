<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonationCertificate;
use App\Regional;

class DonationCertificateController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $donations = DonationCertificate::join('regionals','donation_certificates.id_regional','=','regionals.id')
            ->select('donation_certificates.id',
                     'donation_certificates.noActa',
                     'donation_certificates.nameScientific',
                     'donation_certificates.observation',
                     'donation_certificates.nameCommon',
                     'donation_certificates.presentation',
                     'donation_certificates.amount',
                     'donation_certificates.weight',
                     'donation_certificates.commercialValue',
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
                     
                     'donation_certificates.id_regional','regionals.name as nameRegional',
                     
            )
        
            ->paginate(9999999999999999999999999);

        return [     
            'donations' => $donations
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $donations = new DonationCertificate();
        $donations->noActa = $request->noActa;
        $donations->nameScientific = $request->nameScientific;
        $donations->observation = $request->observation;
        $donations->nameCommon = $request->nameCommon;
        $donations->presentation = $request->presentation;
        $donations->amount = $request->amount;
        $donations->weight = $request->weight;
        $donations->commercialValue = $request->commercialValue;
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
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $donations = DonationCertificate::findOrFail($request->id); 
        $donations->noActa = $request->noActa;
        $donations->nameScientific = $request->nameScientific;
        $donations->observation = $request->observation;
        $donations->nameCommon = $request->nameCommon;
        $donations->presentation = $request->presentation;
        $donations->amount = $request->amount;
        $donations->weight = $request->weight;
        $donations->commercialValue = $request->commercialValue;
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
    }
    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $donations = DonationCertificate::findOrFail($request->id);
        $donations->delete();
    }
}
