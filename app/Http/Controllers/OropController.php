<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orop;

class OropController extends Controller
{
     //
     public function index(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $orops = Orop::orderBy('name', 'asc')->get();
 
         return [     
             'data' => $orops
         ];
     }
     public function selectOrop(Request $request)
     {
         $orops = Orop::select('id','name')
             ->orderBy('name', 'asc')->get();
         return [
             'orops' => $orops
         ];
     } 
     public function store(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $orops = new Orop();
         $orops->name = $request->name;    
         $orops->save();
     }
 
     public function update(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $orops = Orop::findOrFail($request->id);
         $orops->name = $request->name;    
         $orops->save();
     }
 
     public function destroy(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $orops = Orop::findOrFail($request->id);
         $orops->delete();
     }
}
