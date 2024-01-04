<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Team;
use App\Models\TeamtoPlayerMatching;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamtoPlayerMatchingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamtoPlayerMatching::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position' => $this->faker->randomElement(['Attacker', 'Goal Keeper', 'Defender', 'Midfielder']),
            'reservation_id' => Reservation::factory(),
            'team_id' => Team::factory(),
        ];
    }
}