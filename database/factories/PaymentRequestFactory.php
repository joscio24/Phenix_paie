<?php
// database/factories/PaymentRequestFactory.php
namespace Database\Factories;

use App\Models\PaymentRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentRequestFactory extends Factory
{
    protected $model = PaymentRequest::class;

    public function definition()
    {
        return [
            'request_name' => $this->faker->word(),
            'request_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
