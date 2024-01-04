<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Location;
use App\Models\SportType;
use App\Models\Team;
use App\Models\TeamtoTeamMatching;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamtoTeamMatchingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamtoTeamMatching::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_time' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'team1_id' => Team::factory(),
            'team2_id' => Team::factory(),
            'club_id' => Club::factory(),
            'location_id' => Location::factory(),
            'sport_type_id' => SportType::factory(),
        ];
    }
}
