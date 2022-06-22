<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FishingGearMaterial;

class FishingGearMaterialController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $materials = FishingGearMaterial::orderBy('name', 'asc')->get();

        return [     
            'materials' => $materials
        ];
    }
    public function selectMaterial(Request $request)
    {
        $materials = FishingGearMaterial::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'materials' => $materials
        ];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $materials = new FishingGearMaterial();
        $materials->name = $request->name;    
        $materials->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $materials = FishingGearMaterial::findOrFail($request->id);
        $materials->name = $request->name;    
        $materials->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $materials = FishingGearMaterial::findOrFail($request->id);
        $materials->delete();
    }
}
