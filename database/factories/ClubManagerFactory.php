<?php

namespace Database\Factories;

use App\Models\ClubManager;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClubManagerFactory extends Factory
{
    protected $model = ClubManager::class;

    public function definition()
    {
        return [
            'code' => $this->faker->numberBetween(100000, 999999),
            'personal_info_id' => function () {
                // Assuming ActorPersonalInfos has records in the database
                return \App\Models\ActorPersonalInfos::inRandomOrder()->first()->id;
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}