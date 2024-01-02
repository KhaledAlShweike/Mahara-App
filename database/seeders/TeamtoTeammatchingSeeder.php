<?php

namespace Database\Seeders;

use App\Http\Controllers\TeamtoTeamMatching;
use App\Models\Club;
use App\Models\Location;
use App\Models\SportType;
use App\Models\Team;
use App\Models\Team_to_Team_matching;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamtoTeamMatchingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
          \App\Models\TeamtoTeamMatching::create([
            'start_time' => now(),  // Adjust this according to your needs
            'end_time' => now()->addHours(2),  // Adjust this according to your needs
            'Team1_id' => Team::inRandomOrder()->value('id'),
            'Team2_id' => Team::inRandomOrder()->value('id'),
            'Club_id' => Club::inRandomOrder()->value('id'),
            'Location_id' => Location::inRandomOrder()->value('id'),
            'SportType_id' => SportType::inRandomOrder()->value('id'),
        ]);
    }
}
