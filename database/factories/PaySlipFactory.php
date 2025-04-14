<?php
// database/factories/PaySlipFactory.php
namespace Database\Factories;

use App\Models\PaySlip;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaySlipFactory extends Factory
{
    public function definition()
    {
        $baseSalary = $this->faker->numberBetween(50000, 150000);
        $housingAllowance = $this->faker->numberBetween(5000, 20000);
        $transportAllowance = $this->faker->numberBetween(2000, 10000);
        $publicServicesAllowance = $this->faker->numberBetween(1000, 5000);

        // Gross Salary Calculation
        $grossSalary = $baseSalary + $housingAllowance + $transportAllowance + $publicServicesAllowance;

        // Deductions
        $taxPAYE = $this->faker->numberBetween(5000, 25000);
        $cnss = ($grossSalary * 5) / 100; // Assuming 5% CNSS deduction
        $totalDeductions = $taxPAYE + $cnss;

        // Net Salary Calculation
        $netSalary = $grossSalary - $totalDeductions;

        return [
            'employee_id' => Employee::factory(),
            'title' => $this->faker->randomElement(['Manager', 'Supervisor', 'Staff']),
            'grade' => $this->faker->randomElement(['Junior', 'Mid-Level', 'Senior']),
            'base_salary' => $baseSalary,
            'housing_allowance' => $housingAllowance,
            'transport_allowance' => $transportAllowance,
            'public_services_allowance' => $publicServicesAllowance,
            'tax_paye' => $taxPAYE,
            'cnss' => $cnss,
            'total_deductions' => $totalDeductions,
            'gross_salary' => $grossSalary,
            'net_salary' => $netSalary,
            'payment_date' => $this->faker->date(),
            'reference_number' => 'PAY-' . strtoupper(Str::random(8)),
        ];
    }
}
