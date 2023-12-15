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
        Schema::create('tournements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->integer('max_team');
            $table->dateTime('start_at')->nullable()->default(now());
            $table->dateTime('end_at')->nullable()->default(now());
            $table->dateTime('start_playing_time')->nullable();
            $table->dateTime('end_playing_time')->nullable();
            $table->foreignId('sport_type_id')->references('id')->on('sport_types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournements');
    }
};
