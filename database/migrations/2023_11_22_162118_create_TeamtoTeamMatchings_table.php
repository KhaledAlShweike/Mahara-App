<?php

use App\Models\Club;
use App\Models\Location;
use App\Models\SportType;
use App\Models\Stadium;
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
        Schema::create('TeamtoTeamMatchings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('slot',[ '0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'])->nullable()->comment("Match start time");
            $table->foreignId('Team1_id')->nullable()->constrained('Teams');
            $table->foreignId('Team2_id')->nullable()->constrained('Teams');
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('Stadiums');
            $table->integer('status');
            $table->foreignIdFor(SportType::class)->nullable()->constrained('SportTypes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TeamtoTeamMatchings');
    }
};
