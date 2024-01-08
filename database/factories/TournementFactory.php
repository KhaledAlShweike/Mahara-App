<?php

namespace Database\Factories;


use App\Models\SportType;
use App\Models\Tournement;
use Illuminate\Database\Eloquent\Factories\Factory;

class TournementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tournement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'location' => $this->faker->city,
            'max_team' => $this->faker->randomNumber(2),
            'start_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_at' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'start_playing_time' => $this->faker->dateTimeBetween('+2 months', '+3 months'),
            'end_playing_time' => $this->faker->dateTimeBetween('+3 months', '+4 months'),
            'sport_type_id' => SportType::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}