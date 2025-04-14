<?php

namespace Database\Seeders;

use App\Models\StaffApplication;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $this->call(AdminsTableSeeder::class);
        // $this->call(PositionSeeder::class);

        // $this->call(AdminsTableSeeder::class);
        // $this->call(PositionSeeder::class);
        // $this->call(DeductionSeeder::class);
        // $this->call(ScheduleSeeder::class);
        // $this->call(EmployeeSeeder::class);
        // $this->call(OvertimeSeeder::class);
        // $this->call(CashAdvanceSeeder::class);
        // $this->call(AttendanceSeeder::class);

        $this->call(EmployesTableSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(PaiementSeeder::class);
        $this->call(TaxSeeder::class);
        $this->call(StaffApplicationSeeder::class);
        $this->call(MemoSeeder::class);
        $this->call(PaymentRequestSeeder::class);
        $this->call(PaySlipSeeder::class);
        // $this->call(TaxSeeder::class);
        // $this->call(PaySlipSeeder::class);
    }
}
