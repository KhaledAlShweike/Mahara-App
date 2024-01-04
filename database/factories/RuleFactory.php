<?php


namespace Database\Factories;

use App\Models\Rule;
use Illuminate\Database\Eloquent\Factories\Factory;

class RuleFactory extends Factory
{
    protected $model = Rule::class;

    public function definition()
    {
        return [
            'Rule' => $this->faker->randomElement(['Player', 'AppAdmin', 'ClubManager', 'Doctor']),
        ];
    }
}
