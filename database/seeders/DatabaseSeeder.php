<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ActorPersonalInfos;
use App\Models\AppAdmin;
use App\Models\Archive;
use App\Models\Club;
use App\Models\ClubManager;
use App\Models\Day;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Location;
use App\Models\Notification;
use App\Models\PendingTeamtoPlayermatching;
use App\Models\PendingTeamtoTeamMatching;
use App\Models\Player;
use App\Models\PlayertoTeammatching;
use App\Models\Position;
use App\Models\Rank;
use App\Models\Report;
use App\Models\Reservation;
use App\Models\Rule;
use App\Models\SportType;
use App\Models\Stadium;
use App\Models\Team;
use App\Models\TeamtoPlayermatching;
use App\Models\TeamtoTeamMatching;
use App\Models\Tournement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        ActorPersonalInfos::factory(10)->create();
        AppAdmin::factory(10)->create();
        Archive::factory(10)->create();
        Club::factory(10)->create();
        ClubManager::factory(10)->create();
        Day::factory(10)->create();
        Doctor::factory(10)->create();
        Image::factory(10)->create();
        Location::factory(10)->create();
        Notification::factory(10)->create();
        PendingTeamtoPlayermatching::factory(10)->create();
        PendingTeamtoTeamMatching::factory(10)->create();
        Player::factory(10)->create();
        Rank::factory(10)->create();
        Report::factory(10)->create();
        Reservation::factory(10)->create();
        Rule::factory(10)->create();
        SportType::factory(10)->create();
        Stadium::factory(10)->create();
        Team::factory(10)->create();
        TeamtoPlayermatching::factory(10)->create();
        TeamtoTeamMatching::factory(10)->create();
        Tournement::factory(10)->create();
        PlayertoTeammatching::factory(10)->create();
        Position::factory(10)->create();

    }
}
