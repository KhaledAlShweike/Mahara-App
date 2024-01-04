<?php
namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        return [
            'Location' => $this->faker->word,
            'clinic_number' => $this->faker->word,
            'personal_info_id' => function () {
                // Assuming ActorPersonalInfos has records in the database
                return \App\Models\ActorPersonalInfo::inRandomOrder()->first()->id;
            },
        ];
    }
}