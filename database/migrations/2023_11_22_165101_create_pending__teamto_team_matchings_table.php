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
        Schema::create('pending__teamto_team_matchings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time')->nullable()->comment("Match start time");
            $table->dateTime('end_time')->nullable()->comment("Match end time");
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending__teamto_team_matchings');
    }
};
