<?php

use App\Models\Club;
use App\Models\Location;
use App\Models\SportType;
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
        Schema::create('PendingTeamtoTeamMatchings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time')->nullable()->comment("Match start time");
            $table->dateTime('end_time')->nullable()->comment("Match end time");
            $table->boolean('status');
            $table->foreignId('Team_one_id')->nullable()->constrained('Teams');
            $table->foreignId('Team_two_id')->nullable()->constrained('Teams');
            $table->foreignIdFor(Club::class)->nullable()->constrained('Clubs');
            $table->foreignIdFor(Location::class)->nullable()->constrained('Locations');
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('Stadiums');
            $table->foreignIdFor(SportType::class)->nullable()->constrained('SportTypes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PendingTeamtoTeamMatchings');
    }
};
