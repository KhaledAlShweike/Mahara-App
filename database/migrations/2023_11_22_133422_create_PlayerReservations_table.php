<?php

use App\Models\Player;
use App\Models\Reservation;
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
        Schema::create('PlayerReservations', function (Blueprint $table) {
           $table->foreignIdFor(Player::class)->nullable()->constrained('Players');
           $table->foreignIdFor(Reservation::class)->nullable()->constrained('Reservations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Player_Reservations');
    }
};
