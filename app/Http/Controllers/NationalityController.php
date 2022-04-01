<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nationality;

class NationalityController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nationality = Nationality::orderBy('name', 'asc')->get();

        return [     
            'data' => $nationality
        ];
    }
    public function selectNationality(Request $request)
    {
        $nationality = Nationality::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'nationality' => $nationality
        ];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nationality = new Nationality();
        $nationality->name = $request->name;    
        $nationality->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nationality = Nationality::findOrFail($request->id);
        $nationality->name = $request->name;    
        $nationality->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $nationality = Nationality::findOrFail($request->id);
        $nationality->delete();
    }
}
