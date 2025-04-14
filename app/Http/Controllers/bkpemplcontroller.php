<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\PaySlip;
use Illuminate\Support\Facades\Auth;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        // Récupérer les données des taxes
        $taxes = Tax::all();

        // Récupérer les bulletins de salaire
        $paySlips = PaySlip::all();

        $user = Auth::user();
        return view('employees', ['userName' => $user->name], compact('employees', 'taxes', 'paySlips'));
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return response()->json([
                'success' => true,
                'data' => $employee
            ]);
        } else {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            // Personal Information
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:Masculin,Féminin,Autres',
            'etat_civil' => 'required|in:Mr,Mme,Mlle',
            'adresse' => 'required|string|max:500',
            'telephone' => 'required|string|max:20', // You can adjust the max length as per your requirement
            'email' => 'required|email|unique:employees,email', // Assuming the email needs to be unique in the `employees` table

            // Professional Information
            'employee_id' => 'required|string|unique:employees,employee_id',
            'poste' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'date_embauche' => 'required|date',
            'type_contrat' => 'required|in:CDI,CDD,Freelance',
            'duree_contrat' => 'required|integer|min:1', // Assuming the duration is in months and must be at least 1 month
            'lieu_affectation' => 'required|string|max:255',

            // Salary Information
            'salaire_base' => 'required|numeric|min:0', // Gross salary, should be a non-negative number
            'mode_paiement' => 'required|in:Virement bancaire,Chèque,Espèces',
            'compte_bancaire' => 'required|string|max:34', // IBAN or account number
            'nom_banque' => 'required|string|max:255',
            'frequence_paiement' => 'required|in:Mensuel,Bimensuel',

            // Fiscal and Social Status
            'num_securite_sociale' => 'required|string|max:9', // Assuming it's a string with a max length of 9
            'num_ifu' => 'required|string|max:12', // Assuming it's a string with a max length of 12
            'retraite' => 'nullable|boolean', // Optional boolean field
            'taxe_appliquee' => 'nullable|boolean', // Optional boolean field

            // Document Uploads (assuming these are optional)
            'contrat_signe' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048', // Example validation for contract file
            'carte_identite' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048', // Example validation for identity card file
            'certificats_diplomes' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048', // Example validation for certificates or diplomas
            'rib' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048', // Example validation for RIB file
        ]);


        $employee = Employee::create($request->all());

        return response()->json(['success' => 'Employee created successfully', 'employee' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $request->validate([
            'nom' => 'nullable|string',
            'prenoms' => 'nullable|string',
            'date_naissance' => 'nullable|date',
            // Add validation for other fields
        ]);

        $employee->update($request->all());

        return response()->json(['success' => 'Employee updated successfully', 'employee' => $employee]);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return response()->json(['success' => 'Employee deleted successfully']);
        }
        return response()->json(['message' => 'Employee not found'], 404);
    }
}
