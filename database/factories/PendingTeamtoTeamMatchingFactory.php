<?php

namespace Database\Factories;
use App\Models\Club;
use App\Models\Location;
use App\Models\PendingTeamtoTeamMatching;
use App\Models\SportType;
use App\Models\Stadium;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendingTeamtoTeamMatchingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PendingTeamtoTeamMatching::class;

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
            'status' => $this->faker->boolean,
            'team_one_id' => Team::factory(),
            'team_two_id' => Team::factory(),
            'club_id' => Club::factory(),
            'location_id' => Location::factory(),
            'stadium_id' => Stadium::factory(),
            'sport_type_id' => SportType::factory(),
        ];
    }
}
