<?php

use App\Models\Club;
use App\Models\Club_manager;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Player;
use App\Models\Reservation;
use App\Models\Sport_type;
use App\Models\Stadium;
use App\Models\Team;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stadium', function (Blueprint $table) {
            $table->foreignIdFor(Sport_type::class)->nullable()->constrained();
        });      



        Schema::table('notification_player', function (Blueprint $table) {
            $table->foreignIdFor(Player::class)->nullable()->constrained();
            $table->foreignIdFor(Notification::class)->nullable()->constrained();
        });



        Schema::table('clubs', function (Blueprint $table) {
            $table->foreignIdFor(Club_manager::class)->constrained()->nullable()->constrained();
            $table->foreignIdFor(Location::class)->constrained()->nullable()->constrained();
        });
        


 Schema::table('pending__teamto_team_matchings', function (Blueprint $table) {
            $table->foreignId('team_one_id')->nullable()->constrained('teams');
            $table->foreignId('team_two_id')->nullable()->constrained('teams');
            $table->foreignIdFor(Club::class)->nullable()->constrained();
            $table->foreignIdFor(Location::class)->nullable()->constrained();
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('stadium');
            $table->foreignIdFor(Sport_type::class)->nullable()->constrained();
        });



        Schema::table('team_to__team_matchings', function (Blueprint $table) {
            $table->foreignIdFor(Team::class)->nullable()->constrained();
            $table->foreignIdFor(Club::class)->nullable()->constrained();
            $table->foreignIdFor(Location::class)->nullable()->constrained();
            $table->foreignIdFor(Sport_type::class)->nullable()->constrained();
        });



        Schema::table('pending__teamto_player_matchings', function (Blueprint $table) {
            $table->foreignIdFor(Reservation::class)->nullable()->constrained();
            $table->foreignIdFor(Team::class)->nullable()->constrained();
            $table->foreignIdFor(Player::class)->nullable()->constrained();
        });



        Schema::table('team_to_player_matchings', function (Blueprint $table) {
            $table->foreignIdFor(Reservation::class)->nullable()->constrained();
            $table->foreignIdFor(Team::class)->nullable()->constrained();
        });



        Schema::table('player_to_team_matchings', function (Blueprint $table) {
            $table->foreignIdFor(Location::class)->nullable()->constrained();
            $table->foreignIdFor(Team::class)->nullable()->constrained();
            $table->foreignIdFor(Player::class)->nullable()->constrained();
            $table->foreignIdFor(Sport_type::class)->nullable()->constrained();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
