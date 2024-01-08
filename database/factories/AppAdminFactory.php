<?php

namespace Database\Factories;

use App\Models\AppAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'personal_info_id' => function () {
                return \App\Models\ActorPersonalInfos::factory()->create()->id;
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
