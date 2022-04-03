<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $company = Company::orderBy('name', 'asc')->get();

        return [     
            'data' => $company
        ];
    }
    public function selectCompanies(Request $request)
    {
        $company = Company::select('id','name')
            ->orderBy('name', 'asc')->get();
        return [
            'company' => $company
        ];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $company = new Company();
        $company->name = $request->name;    
        $company->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $company = Company::findOrFail($request->id);
        $company->name = $request->name;    
        $company->save();
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $company = Company::findOrFail($request->id);
        $company->delete();
    }
}
