<?php

namespace Database\Factories;

use App\Models\SportType;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'Rank' => $this->faker->numberBetween(1, 100),
            'enable_join' => $this->faker->boolean,
            'SportType_id' => SportType::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
