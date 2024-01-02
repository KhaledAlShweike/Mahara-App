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
            $table->enum('Position',['Football','Basketball']);
            $table->enum('Football',['Attacker', ' Gooal Keeper ', ' Defender ', 'Midfielder']);
            $table->enum('Basketball', ['Center',' Power forward', 'Small forward',' Point guard', 'Shooting guard']);
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
