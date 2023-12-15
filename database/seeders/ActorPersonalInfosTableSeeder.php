<?php

namespace Database\Seeders;

use App\Models\Actor_personal_info;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorPersonalInfosTableSeeder extends Seeder
{
    public function run()
    {
        // Insert 25 Player records
        for ($i = 1; $i <= 20; $i++) {
            Actor_Personal_Info::create([
                'first_name' => 'Player'.$i,
                'last_name' => 'Lastname'.$i,
                'Rule' => 'Player',
                'phone_number' => '12345678'.$i,
                'email' => 'player'.$i.'@example.com',
                'password' => bcrypt('password123'),
            ]);
        }

        // Insert Club Manager record
        Actor_Personal_Info::create([
            'first_name' => 'Club',
            'last_name' => 'Manager',
            'Rule' => 'club_manager',
            'phone_number' => '123456789',  // Provide a default phone number
            'code' => '123456',
            'email' => 'club.manager@example.com',
            'password' => bcrypt('clubpassword'),
        ]);

        $this->command->info('ActorPersonalInfos table seeded!');
    }
}
