<?php

namespace Database\Seeders;

use App\Models\StaffApplication;
use Illuminate\Database\Seeder;

class StaffApplicationSeeder extends Seeder
{
    public function run()
    {
        StaffApplication::create([
            'total_applications' => 500,
            'pending' => 80,
            'approved' => 370,
            'rejected' => 50,
        ]);
    }
}
