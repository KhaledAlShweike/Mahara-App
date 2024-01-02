<?php

use App\Models\Reservation;
use App\Models\Stadium;
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
        Schema::create('ReservationStadiums', function (Blueprint $table) {
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('Stadiums');
            $table->foreignIdFor(Reservation::class)->nullable()->constrained('Reservations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ReservationStadiums');
    }
};
