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
        Schema::create('TeamtoPlayerMatchings', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->foreignIdFor(Reservation::class)->nullable()->constrained('Reservations');
            $table->foreignIdFor(Team::class)->nullable()->constrained('Teams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TeamtoPlayerMatchings');
    }
};
