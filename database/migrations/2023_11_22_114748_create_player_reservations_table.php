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
        Schema::create('player_reservations', function (Blueprint $table) {
           $table->unsignedBigInteger('player_id');
           $table->unsignedBigInteger('reservation_id');
           $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_reservations');
    }
};
