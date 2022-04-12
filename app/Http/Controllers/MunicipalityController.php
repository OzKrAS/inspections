<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipality;
use App\Region;

class MunicipalityController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $municipalities = Municipality::join('regions','municipalities.id_region','=','regions.id')
            ->select(
            'municipalities.id', 'municipalities.name', 'municipalities.id_region',
            'regions.name as nameReg')
            ->paginate(9999999999999999999999999);
        
        return [
            'municipalities' => $municipalities
        ];
    }
    public function selectMunicipality(Request $request)
    {
        $municipalities = Municipality::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'municipalities' => $municipalities
        ];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $municipality = new Municipality();
        $municipality->name = $request->name;    
        $municipality->id_region = $request->id_region;    
        $municipality->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $municipality = Municipality::findOrFail($request->id);
        $municipality->name = $request->name;    
        $municipality->id_region = $request->id_region;  
        $municipality->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $municipality = Municipality::findOrFail($request->id);
        $municipality->delete();
    }
}
