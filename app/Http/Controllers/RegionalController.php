<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regional;

class RegionalController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $regional = Regional::orderBy('name', 'asc')->get();

        return [     
            'regional' => $regional
        ];
    }
    public function selectRegional(Request $request)
    {
        $regional = Regional::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'regional' => $regional
        ];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $regional = new Regional();
        $regional->name = $request->name;    
        $regional->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $regional = Regional::findOrFail($request->id);
        $regional->name = $request->name;    
        $regional->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $regional = Regional::findOrFail($request->id);
        $regional->delete();
    }
}
