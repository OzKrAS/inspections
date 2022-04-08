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
                     'donation_certificates.nameCommon',
                     'donation_certificates.presentation',
                     'donation_certificates.amount',
                     'donation_certificates.weight',
                     'donation_certificates.commercialValue',
                     'donation_certificates.date',
                     'donation_certificates.nameOfficial',
                     'donation_certificates.noDocumentId1',
                     
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
        $donations->nameCommon = $request->nameCommon;
        $donations->presentation = $request->presentation;
        $donations->amount = $request->amount;
        $donations->weight = $request->weight;
        $donations->commercialValue = $request->commercialValue;
        $donations->date = $request->date;
        $donations->nameOfficial = $request->nameOfficial;
        $donations->noDocumentId1 = $request->noDocumentId1;

        $donations->id_regional = $request->id_regional;  
        $donations->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $donations = DonationCertificate::findOrFail($request->id); 
        $donations->noActa = $request->noActa;
        $donations->nameScientific = $request->nameScientific;
        $donations->nameCommon = $request->nameCommon;
        $donations->presentation = $request->presentation;
        $donations->amount = $request->amount;
        $donations->weight = $request->weight;
        $donations->commercialValue = $request->commercialValue;
        $donations->date = $request->date;
        $donations->nameOfficial = $request->nameOfficial;
        $donations->noDocumentId1 = $request->noDocumentId1;

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
