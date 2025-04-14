<?php
// database/seeders/TaxSeeder.php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tax;
use App\Models\Employee;
use App\Models\PaySlip;
use Carbon\Carbon;

class PaySlipSeeder extends Seeder
{
    public function run()
    {
        // Récupérer tous les employés actifs
        // $employees = Employee::where('is_active', true)->get();

        // foreach ($employees as $employee) {
        //     // Calcul du salaire brut, des taxes et du salaire net
        //     $grossSalary = $employee->gross_salary;
        //     $taxes = $grossSalary * 0.15; // Par exemple, 15% de taxes
        //     $netSalary = $grossSalary - $taxes;

        //     // Créer une fiche de paie pour chaque employé
        //     PaySlip::create([
        //         'employee_id' => $employee->id,
        //         'gross_salary' => $grossSalary,
        //         'taxes' => $taxes,
        //         'net_salary' => $netSalary,
        //         'payment_date' => Carbon::now(),
        //         'reference_number' => 'PAY' . strtoupper(uniqid()),
        //     ]);
        // }

        PaySlip::factory()->count(7)->create();
    }
}
