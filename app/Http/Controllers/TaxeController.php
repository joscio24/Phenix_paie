<?php

namespace App\Http\Controllers;

use App\Models\Taxe;
use Illuminate\Http\Request;

class TaxeController extends Controller
{
    /**
     * Display a listing of taxes.
     */
    public function index()
    {
        $taxes = Taxe::all(); // Get all taxes
        return view('admin.views.pages.taxe_cotisations');
    }

    /**
     * Show the form for creating a new tax.
     */
    public function create()
    {
        return view('taxes.create');
    }

    /**
     * Store a newly created tax in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0|max:100',
            'base_calculation' => 'required|string|max:255'
            // 'is_active' => 'required|boolean',
        ]);

        $request['is_active'] = true;
        $taxe = Taxe::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Tax created successfully!',
            'data' => $taxe,
        ], 201);
    }

    /**
     * Display the specified tax.
     */
    public function show($id)
    {
        $taxe = Taxe::findOrFail($id); // Find tax by ID or fail
        return response()->json($taxe);
    }

    /**
     * Show the form for editing the specified tax.
     */
    public function edit($id)
    {
        $taxe = Taxe::findOrFail($id); // Find tax by ID or fail
        return view('taxes.edit', compact('taxe'));
    }

    /**
     * Update the specified tax in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0|max:100',
            // 'base_calculation' => 'required|in:gross_salary,taxable_income',
            // 'is_active' => 'required|boolean',
        ]);

        $taxe = Taxe::findOrFail($id); // Find tax by ID or fail
        $taxe->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Tax updated successfully!',
            'data' => $taxe,
        ]);
        // return redirect()->back()->with('success', 'Taxe mise à jour avec succès!');
    }

    /**
     * Remove the specified tax from the database.
     */
    public function destroy($id)
    {
        $taxe = Taxe::findOrFail($id); // Find tax by ID or fail
        $taxe->delete();


    return redirect()->back()->with('success', 'Taxe supprimée avec succès!');
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Tax deleted successfully!',
        // ]);
    }
}
