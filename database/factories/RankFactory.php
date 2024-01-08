<?php

namespace Database\Factories;


use App\Models\Rank;
use Illuminate\Database\Eloquent\Factories\Factory;

class RankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'start_range' => $this->faker->numberBetween(1, 100),
            'end_range' => $this->faker->numberBetween(101, 200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
