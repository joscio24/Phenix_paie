<?php
// database/seeders/TaxSeeder.php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxSeeder extends Seeder
{
    public function run()
    {
        Tax::create([
            'name' => 'Impôt sur le traitement des salaires',
            'rate' => 10,
            'base_calculation' => 'gross_salary',
            'is_active' => true,
        ]);

        Tax::create([
            'name' => 'Cotisation sociale',
            'rate' => 5,
            'base_calculation' => 'gross_salary',
            'is_active' => true,
        ]);
    }
}
