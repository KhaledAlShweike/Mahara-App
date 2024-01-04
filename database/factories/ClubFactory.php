<?php

namespace Database\Factories;
use App\Models\Club;
use App\Models\ClubManager;
use App\Models\Image;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClubFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Club::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'club_manager_id' => ClubManager::factory(),
            'location_id' => Location::factory(),
            'image_id' => Image::factory(),
        ];
    }
}
