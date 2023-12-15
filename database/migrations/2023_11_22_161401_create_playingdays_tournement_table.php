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
        Schema::create('playingdays_tournement', function (Blueprint $table) {
         
            $table->foreignId('tournement_id')->references('id')->on('tournements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('day_id')->references('id')->on('days')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playingdays_tournement');
    }
};
