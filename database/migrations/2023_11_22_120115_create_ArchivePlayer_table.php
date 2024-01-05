<?php

use App\Models\Archive;
use App\Models\Player;
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
            $table->foreignIdFor(Player::class)->nullable()->constrained('Players');
            $table->foreignIdFor(Archive::class)->nullable()->constrained('Archives');
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
