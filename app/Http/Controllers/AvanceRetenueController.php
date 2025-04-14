<?php

namespace App\Http\Controllers;

use App\Models\AvanceRetenue;
use Illuminate\Http\Request;

class AvanceRetenueController extends Controller
{
    public function index()
    {
        $avancesRetenues = AvanceRetenue::with(['employee', 'periodeExercice'])->get();
        return view('avances_retenues.index', compact('avancesRetenues'));
    }

    public function create()
    {
        return view('avances_retenues.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employe_id' => 'required|exists:employees,id',
            'periode_fiscale_id' => 'required|exists:periode_exercices,id',
            'type' => 'required|in:avance,retenue',
            'montant' => 'required|numeric|min:0',
        ]);

        AvanceRetenue::create($request->all());
        return redirect()->back()->with('success', 'Avance/Retenue enregistrée');
    }

    public function edit(AvanceRetenue $avanceRetenue)
    {
        return view('avances_retenues.edit', compact('avanceRetenue'));
    }

    public function update(Request $request, AvanceRetenue $avanceRetenue)
    {
        $request->validate([
            'employe_id' => 'required|exists:employees,id',
            'periode_fiscale_id' => 'required|exists:periode_exercices,id',
            'type' => 'required|in:avance,retenue',
            'montant' => 'required|numeric|min:0',
        ]);

        $avanceRetenue->update($request->all());
        return redirect()->back()->with('success', 'Avance/Retenue mise à jour');
    }

    public function destroy(AvanceRetenue $avanceRetenue)
    {
        $avanceRetenue->delete();
        return redirect()->back()->with('success', 'Avance/Retenue supprimée');
    }


}

