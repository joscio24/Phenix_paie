<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    public function index()
    {
        $conges = Conge::with('employee')->get();
        return view('admin.views.pages.gestion_conges', compact('conges'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_employee' => 'required|exists:employees,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|in:payé,non payé',
        ]);

        Conge::create($request->all());
        return redirect()->back()->with('success', 'Congé ajouté avec succès.');
    }

    public function update(Request $request, Conge $conge)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|in:payé,non payé',
        ]);

        $conge->update($request->all());
        return redirect()->back()->with('success', 'Congé mis à jour.');
    }

    public function destroy(Conge $conge)
    {
        $conge->delete();
        return redirect()->back()->with('success', 'Congé supprimé.');
    }

    public function changerStatut(Conge $conge)
    {
        $conge->etat = 'terminé';
        $conge->save();
        return redirect()->back()->with('success', 'Statut mis à jour.');
    }
}

