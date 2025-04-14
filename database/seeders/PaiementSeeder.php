<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paiement;
use App\Models\Employee;

class PaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            Paiement::create([
                'employee_id' => $employee->id,
                'temps_de_travail_a_payer_debut' => now()->subWeeks(2), // Two weeks ago
                'temps_de_travail_a_payer_fin' => now(), // Current date
                'nombre_heure_travaillée' => rand(30, 40), // Random hours worked
                'heures_supplementaire' => rand(1, 10), // Random overtime hours
                'nombre_heure_assignée' => rand(1, 10), // Random overtime hours
                // 'taxe' => rand(0, 10), // Random overtime hours
                'salaire_brut' => $employee->salaire_brut / $employee->nombre_heure_par_semaine * 40, // Sample calculation
                'montant_a_payer' => ($employee->salaire_brut / $employee->nombre_heure_par_semaine * 40) * ((100 - $employee->taxe) / 100),
            ]);
        }
    }
}
