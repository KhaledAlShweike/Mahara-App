<?php

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
            $table->unsignedBigInteger('Reservation_id');
            $table->unsignedBigInteger('Team_id');
            $table->foreign('Reservation_id')->references('id')->on('Reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Team_id')->references('id')->on('Teams')->onDelete('cascade')->onUpdate('cascade');
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
