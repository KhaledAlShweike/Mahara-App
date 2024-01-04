<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActorPersonalInfo.php>
 */
class ActorPersonalInfoFactory extends Factory
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
            'password' => \Illuminate\Support\Facades\Hash::make('password123'), // You should use bcrypt() or Hash facade to hash passwords
            'Rule_id' => 1, // Replace with an existing Rule_id
            'b_date' => $this->faker->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'gender' => $this->faker->randomElement(['male', 'female']),
        
        ];
    }
}
