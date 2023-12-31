<?php

use App\Models\Sport_type;
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
        Schema::create('position', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sport_type::class)->constrained()->nullable();
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
        Schema::dropIfExists('_position_');
    }
};
