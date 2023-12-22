<?php

use App\Models\Club;
use App\Models\Location;
use App\Models\Sport_type;
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
        Schema::create('pending__teamto_team_matchings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time')->nullable()->comment("Match start time");
            $table->dateTime('end_time')->nullable()->comment("Match end time");
            $table->boolean('status');
            $table->foreignId('team_one_id')->nullable()->constrained('teams');
            $table->foreignId('team_two_id')->nullable()->constrained('teams');
            $table->foreignIdFor(Club::class)->nullable()->constrained();
            $table->foreignIdFor(Location::class)->nullable()->constrained();
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('stadium');
            $table->foreignIdFor(Sport_type::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending__teamto_team_matchings');
    }
};
