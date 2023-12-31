<?php

use App\Models\Player;
use App\Models\Reservation;
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
        Schema::create('pending__teamto_player_matchings', function (Blueprint $table) {
            $table->id();
            $table->boolean('accepted');
            $table->foreignIdFor(Reservation::class)->nullable()->constrained();
            $table->foreignIdFor(Team::class)->nullable()->constrained();
            $table->foreignIdFor(Player::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending__teamto_player_matchings');
    }
};
