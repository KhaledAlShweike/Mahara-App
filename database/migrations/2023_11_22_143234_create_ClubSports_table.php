<?php

use App\Models\Club;
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
        Schema::create('ClubSports', function (Blueprint $table) {
            $table->foreignIdFor(SportType::class)->nullable()->constrained('SportTypes');
            $table->foreignIdFor(Club::class)->nullable()->constrained('Clubs');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ClubSports');
    }
};
