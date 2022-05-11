<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ports;


class PortsController extends Controller
{

    public function index(Request $request)
    {
      //  if (!$request->ajax()) return redirect('/');
        $port = Ports::orderBy('name', 'asc')->get();

        return [     
            'data' => $port
        ];
    }
    public function selectPort(Request $request)
    {
        $port = Ports::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'port' => $port
        ];
    } 
    public function store(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');
        $port = new Ports();
        $port->name = $request->name;    
        $port->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $port = Ports::findOrFail($request->id);
        $port->name = $request->name;    
        $port->save();
    }
    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $port = Ports::findOrFail($request->id);
        $port->delete();
    }
}
