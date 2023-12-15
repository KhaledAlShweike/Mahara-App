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
        Schema::create('reservation_stadium', function (Blueprint $table) {
            $table->foreignId('stadium_id')->references('id')->on('stadium')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('reservation_id')->references('id')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_stadium');
    }
};
