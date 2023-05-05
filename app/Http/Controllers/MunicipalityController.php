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
            'municipalities.id', 'municipalities.name', 'municipalities.id_region','regions.name as nameReg')
            
            ->paginate(9999999999999999999999999);
        
        return [
            'municipalities' => $municipalities
        ];
    }
    public function selectMunicipality(Request $request)
    {
        // $municipalities = Municipality::join('regions','municipalities.id_region','=','regions.id')
        // ->selectRaw("CONCAT(municipalities.name, ' - ', regions.name) as namePlace,
        // municipalities.id, municipalities.name, municipalities.id_region,regions.name as nameReg")
        $municipalities = Municipality::orderBy('name', 'asc')->get();
        
            return [
            'municipalities' => $municipalities
        ];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $municipalities = new Municipality();
        $municipalities->name = $request->name;    
        $municipalities->id_region = $request->id_region;    
        $municipalities->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $municipalities = Municipality::findOrFail($request->id);
        $municipalities->name = $request->name;    
        $municipalities->id_region = $request->id_region;  
        $municipalities->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $municipalities = Municipality::findOrFail($request->id);
        $municipalities->delete();
    }
}
