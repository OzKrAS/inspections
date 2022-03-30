<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckDetFlap;

class CheckDetFlapController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = CheckDetFlap::orderBy('id', 'asc')->get();

        return [     
            'data' => $checkDetFlaps
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = new CheckDetFlap();
        $checkDetFlaps->region = $request->region;
        $checkDetFlaps->office = $request->office;
        $checkDetFlaps->official = $request->official;
        $checkDetFlaps->boat = $request->boat;
        $checkDetFlaps->enrollment = $request->enrollment;
        $checkDetFlaps->outhFhisher = $request->outhFhisher;
        $checkDetFlaps->fishLicense = $request->fishLicense;
        $checkDetFlaps->business = $request->business;
        $checkDetFlaps->owner = $request->business;
        $checkDetFlaps->fishCaptain = $request->fishCaptain;
        $checkDetFlaps->location = $request->location;
        $checkDetFlaps->date = $request->date;
        $checkDetFlaps->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = CheckDetFlap::findOrFail($request->id); 
        $checkDetFlaps->region = $request->region;
        $checkDetFlaps->office = $request->office;
        $checkDetFlaps->official = $request->official;
        $checkDetFlaps->boat = $request->boat;
        $checkDetFlaps->enrollment = $request->enrollment;
        $checkDetFlaps->outhFhisher = $request->outhFhisher;
        $checkDetFlaps->fishLicense = $request->fishLicense;
        $checkDetFlaps->business = $request->business;
        $checkDetFlaps->owner = $request->business;
        $checkDetFlaps->fishCaptain = $request->fishCaptain;
        $checkDetFlaps->location = $request->location;
        $checkDetFlaps->date = $request->date; 
        $checkDetFlaps->save();
    }
    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $checkDetFlaps = CheckDetFlap::findOrFail($request->id);
        $checkDetFlaps->delete();
    }
}
