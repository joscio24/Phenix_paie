<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Display a list of companies
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    // Store a new company
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'ifu' => 'required|string|unique:companies,ifu|max:13',
                'date_creation' => 'required|date',
                'adresse' => 'required|string|max:255',
                'telephone' => 'required|string|max:15',
                'email' => 'required|email|unique:companies,email',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $data = $request->only(['nom', 'ifu', 'date_creation', 'adresse', 'telephone', 'email']);

            if ($request->hasFile('logo')) {
                $fileName = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('uploads'), $fileName);
                $data['logo'] = 'uploads/' . $fileName;
            }

            $company = Company::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Entreprise créée avec succès !',
                'company' => $company
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage()
            ], 500);
        }
    }


    // Display a single company
    public function show(Company $company)
    {
        return response()->json($company);
    }

    // Update a company
    public function update(Request $request, $id)
{
    try {
        $company = Company::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'ifu' => "required|string|max:13|unique:companies,ifu,$id",
            'date_creation' => 'required|date',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'email' => "required|email|unique:companies,email,$id",
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $company->update($request->only(['nom', 'ifu', 'date_creation', 'adresse', 'telephone', 'email']));

        if ($request->hasFile('logo')) {
            $fileName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads'), $fileName);
            $company->logo = 'uploads/' . $fileName;
            $company->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Entreprise mise à jour avec succès !',
            'company' => $company
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur s\'est produite : ' . $e->getMessage()
        ], 500);
    }
}


    // Delete a company
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully']);
    }
}
