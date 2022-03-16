<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $region = Region::orderBy('name', 'asc')->get();

        return [     
            'data' => $region
        ];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $region = new Region();
        $region->name = $request->name;    
        $region->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $region = Region::findOrFail($request->id);
        $region->name = $request->name;    
        $region->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $region = Region::findOrFail($request->id);
        $region->delete();
    }
}
