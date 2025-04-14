<?php

namespace Database\Seeders;

use App\Models\PaymentRequest;
use Illuminate\Database\Seeder;

class PaymentRequestSeeder extends Seeder
{
    public function run()
    {
        PaymentRequest::factory()->count(10)->create();
    }
}
