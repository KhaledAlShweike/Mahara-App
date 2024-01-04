<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\ActorPersonalInfo::factory(10)->create();
        \App\Models\AppAdmin::factory(10)->create();
        \App\Models\Archive::factory(10)->create();
        \App\Models\Club::factory(10)->create();
        \App\Models\ClubManager::factory(10)->create();
        \App\Models\Day::factory(10)->create();
        \App\Models\Doctor::factory(10)->create();
        \App\Models\Image::factory(10)->create();
        \App\Models\Location::factory(10)->create();
        \App\Models\Notification::factory(10)->create();
        \App\Models\PendingTeamtoPlayermatching::factory(10)->create();
        \App\Models\PendingTeamtoTeamMatching::factory(10)->create();
        \App\Models\Player::factory(10)->create();
        \App\Models\Rank::factory(10)->create();
        \App\Models\Report::factory(10)->create();
        \App\Models\Reservation::factory(10)->create();
        \App\Models\Rule::factory(10)->create();
        \App\Models\SportType::factory(10)->create();
        \App\Models\Stadium::factory(10)->create();
        \App\Models\Team::factory(10)->create();
        \App\Models\TeamtoPlayermatching::factory(10)->create();
        \App\Models\TeamtoTeamMatching::factory(10)->create();
        \App\Models\Tournement::factory(10)->create();
        \App\Models\PlayertoTeammatching::factory(10)->create();
        \App\Models\Position::factory(10)->create();

    }
}
