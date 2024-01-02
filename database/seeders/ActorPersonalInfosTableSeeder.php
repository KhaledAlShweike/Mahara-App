<?php

namespace Database\Seeders;

use App\Models\ActorPersonalInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorPersonalInfosTableSeeder extends Seeder
{
    public function run()
    {
        // Insert 25 Player records
        for ($i = 1; $i <= 20; $i++) {
            ActorPersonalInfo::create([
                'first_name' => 'Player'.$i,
                'last_name' => 'Lastname'.$i,
                'Rule' => 'Player',
                'phone_number' => '12345678'.$i,
                'email' => 'Player'.$i.'@example.com',
                'password' => bcrypt('password123'),
            ]);
        }

        // Insert Club Manager record
        ActorPersonalInfo::create([
            'first_name' => 'Club',
            'last_name' => 'Manager',
            'Rule' => 'ClubManager',
            'phone_number' => '123456789',  // Provide a default phone number
            'code' => '123456',
            'email' => 'Club.manager@example.com',
            'password' => bcrypt('Clubpassword'),
        ]);

        $this->command->info('ActorPersonalInfos table seeded!');
    }
}
