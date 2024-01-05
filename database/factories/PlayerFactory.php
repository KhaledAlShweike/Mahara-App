<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        return [
            'personal_info_id' => function () {
                return \App\Models\ActorPersonalInfos::factory()->create()->id;
            },
            'image_id' => function () {
                return \App\Models\Image::factory()->create()->id;
            },
            'token' => Str::random(32), // or use any logic to generate a token
        ];
    }
}