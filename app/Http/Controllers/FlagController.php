<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flag;

class FlagController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $flag = Flag::orderBy('name', 'asc')->get();

        return [     
            'data' => $flag
        ];
    }
    public function selectflag(Request $request)
    {
        $flag = Flag::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'flag' => $flag
        ];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $flag = new Flag();
        $flag->name = $request->name;    
        $flag->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $flag = Flag::findOrFail($request->id);
        $flag->name = $request->name;    
        $flag->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $flag = Flag::findOrFail($request->id);
        $flag->delete();
    }
}
