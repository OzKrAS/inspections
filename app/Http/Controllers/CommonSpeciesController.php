<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommonSpecies;

class CommonSpeciesController extends Controller
{
    //
    public function selectSpecie(Request $request)
    {
        $species = CommonSpecies::select('id','commonname','scientificname')
            ->orderBy('commonname', 'asc')->get();
        return [
            'species' => $species
        ];
    } 
}
