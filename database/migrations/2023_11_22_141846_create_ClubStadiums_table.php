<?php

use App\Models\Club;
use App\Models\Stadium;
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
        Schema::create('ClubStadiums', function (Blueprint $table) {
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('Stadiums');
            $table->foreignIdFor(Club::class)->nullable()->constrained('Clubs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ClubStadiums');
    }
};
