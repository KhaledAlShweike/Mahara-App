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
        Schema::create('PlayingDaysTournements', function (Blueprint $table) {
         
            $table->foreignId('Tournement_id')->references('id')->on('Tournements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('Day_id')->references('id')->on('Days')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PlayingDaysTournements');
    }
};
