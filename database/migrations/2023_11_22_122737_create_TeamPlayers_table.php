<?php

use App\Models\Player;
use App\Models\Team;
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
        Schema::create('TeamPlayers', function (Blueprint $table) {
            $table->boolean('Captin');
            $table->foreignIdFor(Player::class)->nullable()->constrained(); 
            $table->foreignIdFor(Team::class)->nullable()->constrained();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TeamPlayers');
    }
};
