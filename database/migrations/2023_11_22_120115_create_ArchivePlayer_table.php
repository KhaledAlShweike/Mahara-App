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
        Schema::create('ArchivePlayer', function (Blueprint $table) {
            $table->unsignedBigInteger('Player_id');
            $table->unsignedBigInteger('Archive_id');
            $table->foreign('Player_id')->references('id')->on('Players')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Archive_id')->references('id')->on('Archives')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Archive_Player');
    }
};
