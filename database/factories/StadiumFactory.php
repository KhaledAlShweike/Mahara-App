<?php

namespace Database\Factories;

use App\Models\SportType;
use App\Models\Stadium;
use Illuminate\Database\Eloquent\Factories\Factory;

class StadiumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stadium::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Stadium_type' => $this->faker->word,
            'price' => $this->faker->randomNumber(4),
            'discount' => $this->faker->randomFloat(2, 0, 1),
            'sport_type_id' => SportType::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}