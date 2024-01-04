<?php

namespace Database\Factories;
use App\Models\PendingTeamtoPlayerMatching;
use App\Models\Player;
use App\Models\Reservation;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendingTeamtoPlayerMatchingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PendingTeamtoPlayerMatching::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'accepted' => $this->faker->boolean,
            'reservation_id' => Reservation::factory(),
            'team_id' => Team::factory(),
            'player_id' => Player::factory(),
        ];
    }
}