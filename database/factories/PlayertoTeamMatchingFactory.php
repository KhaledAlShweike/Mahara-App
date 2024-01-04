<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Player;
use App\Models\PlayertoTeamMatching;
use App\Models\SportType;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayertoTeamMatchingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlayertoTeamMatching::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position' => $this->faker->randomElement(['Attacker', 'Goal Keeper', 'Defender', 'Midfielder']),
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime(),
            'location_id' => Location::factory(),
            'team_id' => Team::factory(),
            'player_id' => Player::factory(),
            'sport_type_id' => SportType::factory(),
        ];
    }
}