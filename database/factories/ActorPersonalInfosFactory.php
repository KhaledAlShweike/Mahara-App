<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActorPersonalInfos.php>
 */
class ActorPersonalInfosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'Rule'=>'player',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'), // You should use bcrypt() or Hash facade to hash passwords
            'b_date' => $this->faker->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'gender' => $this->faker->randomElement(['male', 'female']),
        
        ];
    }
}
