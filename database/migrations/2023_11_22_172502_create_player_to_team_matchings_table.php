<?php

use App\Models\Location;
use App\Models\Player;
use App\Models\Sport_type;
use App\Models\Team;
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
        Schema::create('player_to_team_matchings', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->dateTime('start_time')->nullable()->comment("Match start time");
            $table->dateTime('end_time')->nullable()->comment("Match end time");
            $table->foreignIdFor(Location::class)->nullable()->constrained();
            $table->foreignIdFor(Team::class)->nullable()->constrained();
            $table->foreignIdFor(Player::class)->nullable()->constrained();
            $table->foreignIdFor(Sport_type::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_to_team_matchings');
    }
};
