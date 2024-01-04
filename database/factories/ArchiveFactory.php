<?php


namespace Database\Factories;

use App\Models\Archive;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArchiveFactory extends Factory
{
    protected $model = Archive::class;

    public function definition()
    {
        return [
            'Final_resault' => $this->faker->randomFloat(2, 0, 100),
            'reservation_id' => Reservation::factory(),
        ];
    }
}
