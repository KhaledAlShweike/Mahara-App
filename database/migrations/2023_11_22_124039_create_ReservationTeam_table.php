<?php

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
        Schema::create('ReservationTeam', function (Blueprint $table) {
            $table->foreignIdFor(Reservation::class)->nullable()->constrained('Reservations');
            $table->foreignIdFor(Team::class)->nullable()->constrained('Teams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ReservationTeam');
    }
};
