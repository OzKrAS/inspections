<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckDetInch;

class CheckDetInchController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $CheckDetInchs = CheckDetInch::orderBy('id', 'asc')->get();

        return [     
            'data' => $CheckDetInchs
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $CheckDetInchs = new CheckDetInch();
        $CheckDetInchs->region = $request->region;
        $CheckDetInchs->office = $request->office;
        $CheckDetInchs->official = $request->official;
        $CheckDetInchs->boat = $request->boat;
        $CheckDetInchs->enrollment = $request->enrollment;
        $CheckDetInchs->outhFhisher = $request->outhFhisher;
        $CheckDetInchs->fishLicense = $request->fishLicense;
        $CheckDetInchs->business = $request->business;
        $CheckDetInchs->owner = $request->business;
        $CheckDetInchs->fishCaptain = $request->fishCaptain;
        $CheckDetInchs->location = $request->location;
        $CheckDetInchs->date = $request->date;
        $CheckDetInchs->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $CheckDetInchs = CheckDetInch::findOrFail($request->id); 
        $CheckDetInchs->region = $request->region;
        $CheckDetInchs->office = $request->office;
        $CheckDetInchs->official = $request->official;
        $CheckDetInchs->boat = $request->boat;
        $CheckDetInchs->enrollment = $request->enrollment;
        $CheckDetInchs->outhFhisher = $request->outhFhisher;
        $CheckDetInchs->fishLicense = $request->fishLicense;
        $CheckDetInchs->business = $request->business;
        $CheckDetInchs->owner = $request->business;
        $CheckDetInchs->fishCaptain = $request->fishCaptain;
        $CheckDetInchs->location = $request->location;
        $CheckDetInchs->date = $request->date; 
        $CheckDetInchs->save();
    }
    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $CheckDetInchs = CheckDetInch::findOrFail($request->id);
        $CheckDetInchs->delete();
    }
}
