<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Phenix Admin',
            'email' => 'admin@phenix.com',
            'password' => Hash::make('password123'), // Encrypt the password
            'role' => 'admin', // Assign any role (admin, hr_manager, or accountant)
            'is_active' => true, // Set the user as active
        ]);
    }
}

