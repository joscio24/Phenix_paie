<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeExercice;
use Carbon\Carbon;

class PeriodeExerciceController extends Controller
{
    public function index()
    {
        $periodes = PeriodeExercice::orderBy('date_debut', 'desc')->get();
        return view('admin.periodes.index', compact('periodes'));
    }

    public function getPeriodes()
    {
        $periodes = PeriodeExercice::orderBy('date_debut', 'desc')->get();
        return response()->json($periodes);
    }


    public function store(Request $request)
    {
        $generateAll = $request->input('generate_all', false); // Check if 12 months should be generated
        $year = $request->input('year', date('Y')); // Default to current year

        if ($generateAll) {
            // Generate for 12 months
            for ($month = 1; $month <= 12; $month++) {
                $this->createFiscalPeriod($year, $month);
            }
            return redirect()->back()->with('success', 'Les périodes fiscales pour les 12 mois ont été créées.');
        } else {
            // Generate for a single month
            $month = $request->input('month', date('m')); // Use passed month or current month
            $this->createFiscalPeriod($year, $month);

            return redirect()->back()->with('success', 'Période fiscale créée pour ' . Carbon::createFromFormat('m', $month)->format('F') . '.');
        }
    }

    // Function to create a fiscal period if it does not exist
    private function createFiscalPeriod($year, $month)
    {
        $exists = PeriodeExercice::whereYear('date_debut', $year)
            ->whereMonth('date_debut', $month)
            ->exists();

        if (!$exists) {
            PeriodeExercice::generateFiscalPeriod($month); // Ensure this method exists in your Model
        }
    }


    public function edit($id)
    {
        $periode = PeriodeExercice::findOrFail($id);
        return view('admin.periodes.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $periode = PeriodeExercice::findOrFail($id);
        $periode->update($request->all());

        return redirect()->back()->with('success', 'Période mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $periode = PeriodeExercice::findOrFail($id);
        $periode->delete();

        return redirect()->back()->with('success', 'Période supprimée avec succès.');
    }
}
