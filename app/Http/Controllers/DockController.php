<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dock;
use App\Ports;

class DockController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

            $docks = Dock::join('ports','docks.id_port','=','ports.id')
           ->selectRaw("CONCAT(ports.name, ' - ', docks.name) as nameDock, docks.id, docks.name, docks.arrival, docks.zarpe, docks.id_port,
                        ports.name as namePort")
            ->paginate(9999999999999999);
        
        return [
            'docks' => $docks
        ];
    }
  
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $docks = new Dock();
        $docks->name = $request->name;    
        $docks->arrival = $request->arrival;    
        $docks->zarpe = $request->zarpe;    
        $docks->id_port = $request->id_port;    
        $docks->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $docks = Dock::findOrFail($request->id);
        $docks->name = $request->name;    
        $docks->arrival = $request->arrival;    
        $docks->zarpe = $request->zarpe;     
        $docks->id_port = $request->id_port;  
        $docks->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $docks = Dock::findOrFail($request->id);
        $docks->delete();
    }
    
    public function selectDocks(Request $request)
    {
        // ->selectRaw("CONCAT(ports.name, ' - ', docks.name) as namePort, ports.name as otro")
        $port = Dock::join('ports','docks.id_port','=','ports.id')
            ->selectRaw("CONCAT(ports.name, ' / ', docks.name) as nameDock,docks.id, docks.name,docks.arrival,docks.zarpe,docks.id_port,
            ports.name as namePort")
            ->orderBy('docks.name', 'asc')->get();
        return [
            'port' => $port
        ];
    } 
}
