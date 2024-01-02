<?php

use App\Models\SportType;
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
        Schema::create('Tournements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Location');
            $table->integer('max_Team');
            $table->dateTime('start_at')->nullable()->default(now());
            $table->dateTime('end_at')->nullable()->default(now());
            $table->dateTime('start_playing_time')->nullable();
            $table->dateTime('end_playing_time')->nullable();
            $table->foreignIdFor(SportType::class)->nullable()->constrained('SportTypes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tournements');
    }
};
