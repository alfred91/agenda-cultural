<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(5);
        // LIMITAR LA CANTIDAD DE CARACTERES QUE SE MUESTRAN EN LA TABLA
        $companies->transform(function ($company) {
            $company->extra_info = Str::limit($company->extra_info, 60, '...');
            return $company;
        });
        return view('admin.company', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'address' => 'required|string|max:200',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:100',
            'website' => 'nullable|string|max:200',
            'extra_info' => 'nullable|string',
        ]);

        Company::create($request->all());

        return back()->with('success', 'Empresa creada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return back()->with('success', 'Empresa eliminada con éxito.');
    }
}
