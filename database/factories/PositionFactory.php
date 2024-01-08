<?php

namespace Database\Factories;


use App\Models\Position;
use App\Models\SportType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sport_type_id' => SportType::factory(),
            'position' => $this->faker->randomElement([
                'Attacker', 'Goal Keeper', 'Defender', 'Midfielder', 'Center', 'Power Forward', 'Small Forward', 'Point Guard', 'Shooting Guard'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
