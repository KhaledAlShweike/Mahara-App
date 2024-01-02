<?php

use App\Models\Notification;
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
        Schema::create('NotificationPlayers', function (Blueprint $table) {
           $table->foreignIdFor(Player::class)->nullable()->constrained();
           $table->foreignIdFor(Notification::class)->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NotificationPlayers');
    }
};
