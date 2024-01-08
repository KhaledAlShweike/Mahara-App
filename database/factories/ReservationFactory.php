<?php 
namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'start_datetime' => $this->faker->dateTimeBetween('now', '+30 days'),
            'end_datetime' => $this->faker->dateTimeBetween('+31 days', '+60 days'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
