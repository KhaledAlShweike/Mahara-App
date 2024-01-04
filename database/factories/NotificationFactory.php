<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'flow_id' => $this->faker->uuid,
            'expire_date' => $this->faker->dateTimeThisYear,
            'is_read' => $this->faker->boolean,
        ];
    }
}