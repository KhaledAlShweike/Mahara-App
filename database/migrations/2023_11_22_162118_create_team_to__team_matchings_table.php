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
        Schema::create('team_to__team_matchings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time')->nullable()->comment("Match start time");
            $table->dateTime('end_time')->nullable()->comment("Match end time");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_to__team_matchings');
    }
};
