<?php
// database/factories/StaffApplicationFactory.php
namespace Database\Factories;

use App\Models\StaffApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffApplicationFactory extends Factory
{
    protected $model = StaffApplication::class;

    public function definition()
    {
        return [
            'total_applications' => $this->faker->numberBetween(1, 100),
            'pending' => $this->faker->numberBetween(1, 50),
            'approved' => $this->faker->numberBetween(1, 50),
            'rejected' => $this->faker->numberBetween(1, 50),
        ];
    }
}
