<?php

namespace Database\Factories;

use App\Models\AppAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppAdminFactory extends Factory
{
    protected $model = AppAdmin::class;

    public function definition()
    {
        return [
            'personal_info_id' => function () {
                // Assuming ActorPersonalInfos has records in the database
                return \App\Models\ActorPersonalInfo::inRandomOrder()->first()->id;
            },
        ];
    }
}
