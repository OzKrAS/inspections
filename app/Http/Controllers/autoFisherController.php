<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AutoFisher;

class autoFisherController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $autoFisher = AutoFisher::orderBy('name',  'asc')->get();

        return [     
            'data' => $autoFisher
        ];
    } 
    public function selectZoneAutoFisher(Request $request)
    {
        $autoFisher = AutoFisher::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'autoFisher' => $autoFisher
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $autoFisher = new AutoFisher();
        $autoFisher->name = $request->name;    
        $autoFisher->state = $request->state;    
        $autoFisher->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $autoFisher = AutoFisher::findOrFail($request->id);
        $autoFisher->name = $request->name;    
        $autoFisher->state = $request->state;    
        $autoFisher->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $autoFisher = AutoFisher::findOrFail($request->id);
        $autoFisher->delete();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $autoFisher = AutoFisher::findOrFail($request->id);
        $autoFisher->edo = '0';
        $autoFisher->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $autoFisher = AutoFisher::findOrFail($request->id);
        $autoFisher->edo = '1';
        $autoFisher->save();
    }
}
