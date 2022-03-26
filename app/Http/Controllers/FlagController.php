<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flag;

class FlagController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $flags = Flag::orderBy('name', 'asc')->get();

        return [     
            'data' => $flags
        ];
    }
    public function selectFlag(Request $request)
    {
        $flags = Flag::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'flags' => $flags
        ];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $flags = new Flag();
        $flags->name = $request->name;    
        $flags->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $flags = Flag::findOrFail($request->id);
        $flags->name = $request->name;    
        $flags->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $flags = Flag::findOrFail($request->id);
        $flags->delete();
    }
}
