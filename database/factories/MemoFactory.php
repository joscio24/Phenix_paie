<?php
// database/factories/MemoFactory.php
namespace Database\Factories;

use App\Models\Memo;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemoFactory extends Factory
{
    protected $model = Memo::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'sent_by' => Employee::factory(), // Assuming the Employee model has a factory
            'recipient' => Employee::factory(), // Assuming the Employee model has a factory
            'status' => $this->faker->randomElement(['sent', 'draft']),
        ];
    }
}
