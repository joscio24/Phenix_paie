<?php

namespace Database\Seeders;

use App\Models\Memo;
use Illuminate\Database\Seeder;

class MemoSeeder extends Seeder
{
    public function run()
    {
        Memo::factory()->count(10)->create();
    }
}
