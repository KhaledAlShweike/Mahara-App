<?php

use App\Models\Day;
use App\Models\Tournement;
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
            $table->foreignIdFor(Tournement::class)->nullable()->constrained('Tournements');
            $table->foreignIdFor(Day::class)->nullable()->constrained('Days');
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
