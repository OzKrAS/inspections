<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FisheryAuthorized;

class FisheryAuthorizedController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fishery = FisheryAuthorized::orderBy('name', 'asc')->get();

        return [     
            'data' => $fishery
        ];
    }
    public function selectFisheryAuthorized(Request $request)
    {
        $fishery = FisheryAuthorized::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'fishery' => $fishery
        ];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fishery = new FisheryAuthorized();
        $fishery->name = $request->name;    
        $fishery->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fishery = FisheryAuthorized::findOrFail($request->id);
        $fishery->name = $request->name;    
        $fishery->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $fishery = FisheryAuthorized::findOrFail($request->id);
        $fishery->delete();
    }
}
