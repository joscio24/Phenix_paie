<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function index()
    // {
    //     return view('paiements');
    // }

    public function bonsPaiement()
    {
        return view('bons-paiement');
    }
    public function create($employe_id)
    {

        $user = Auth::user();
        $employees = Employee::findOrFail($employe_id);
        return view('paiements_create', ['userName' => $user->name], compact('employees'));
    }

    public function payer()
    {

        $user = Auth::user();
        $employees = Employee::all();

        // Fetch all employees with their weekly hours and base salary
        // $employees = Employee::all(['id', 'nom', 'prenom', 'nombre_heure_par_semaine', 'salaire_base']);
        return view('paiements_create', ['userName' => $user->name], compact('employees'));
    }

    public function creatPayment(){
        $user = Auth::user();
        $employees = Employee::all();
        return view('paiements.create', ['userName' => $user->name], compact('employees'));
    }

    // Store the payment data in the database
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'temps_de_travail_a_payer_debut' => 'required|date',
            'temps_de_travail_a_payer_fin' => 'required|date|after_or_equal:temps_de_travail_a_payer_debut',
            'periode_fiscale_id' => 'required|exists:periode_exercices,id',
            'salaire_base' => 'required|numeric|min:0',
            'deduction' => 'required|numeric|min:0', // Taxe appliquée
            'salaire_brut' => 'required|numeric|min:0',
            'allocation' => 'nullable|numeric|min:0',
            'retenue_salaire' => 'nullable|numeric|min:0',
            'avance_salaire' => 'nullable|numeric|min:0',
            'prime' => 'nullable|numeric|min:0',
        ]);

        // Fetch the employee details
        $employee = Employee::findOrFail($validatedData['employee_id']);

        // Calculate tax amount
        $taxAmount = ($validatedData['salaire_brut'] * $validatedData['deduction']) / 100;

        // Calculate net salary
        $salaireNet = $validatedData['salaire_brut'] - $taxAmount + ($validatedData['allocation'] ?? 0) + ($validatedData['prime'] ?? 0);

        // Create the paiement record
        Paiement::create([
            'employee_id' => $validatedData['employee_id'],
            'temps_de_travail_a_payer_debut' => $validatedData['temps_de_travail_a_payer_debut'],
            'temps_de_travail_a_payer_fin' => $validatedData['temps_de_travail_a_payer_fin'],
            'periode_fiscale_id' => $validatedData['periode_fiscale_id'],
            'salaire_base' => $validatedData['salaire_base'],
            'deduction' => $validatedData['deduction'],
            'salaire_brut' => $validatedData['salaire_brut'],
            'allocation' => $validatedData['allocation'] ?? 0,
            'avance_salaire' => $validatedData['avance_salaire'] ?? 0,
            'retenue_salaire' => $validatedData['retenue_salaire'] ?? 0,
            'prime' => $validatedData['prime'] ?? 0,
            'montant_a_payer' => $salaireNet, // Net salary after tax, allocations, and bonuses
        ]);

        // Redirect with success message
        return redirect()->route('admin.paiements')->with('success', 'Paiement créé avec succès.');
    }


    // Show a list of all payments
    public function index()
    {
        // Fetch all payments with the associated employee

        $user = Auth::user();
        $paiements = Paiement::with('employee')->get();
        // Load payments with associated employee data
        return view('paiements',['userName' => $user->name], compact('paiements')); // Pass payments to the view

    }

    // Show a specific payment
    public function show($id)
    {
        // Find the payment by ID with the associated employee
        $paiement = Paiement::with('employe')->findOrFail($id);

        return view('paiements', compact('paiement'));
    }

    // Method to print the payment slip (you will need to create this view)
    public function print($id)
    {
        // Find the payment and associated employee for printing
        $paiement = Paiement::with('employe')->findOrFail($id);

        return view('paiements.print', compact('paiement'));
    }
}
