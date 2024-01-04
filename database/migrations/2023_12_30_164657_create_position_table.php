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
        Schema::create('Position', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SportType::class)->constrained('SportTypes')->nullable();
            $table->string('Position',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Position');
    }
};
