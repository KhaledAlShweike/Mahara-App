<?php

use App\Models\Location;
use App\Models\Player;
use App\Models\SportType;
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
        Schema::create('PlayertoTeamMatchings', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->dateTime('start_time')->nullable()->comment("Match start time");
            $table->dateTime('end_time')->nullable()->comment("Match end time");
            $table->foreignIdFor(Location::class)->nullable()->constrained('Locations');
            $table->foreignIdFor(Team::class)->nullable()->constrained('Teams');
            $table->foreignIdFor(Player::class)->nullable()->constrained('Players');
            $table->foreignIdFor(SportType::class)->nullable()->constrained('SportTypes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PlayertoTeamMatchings');
    }
};
