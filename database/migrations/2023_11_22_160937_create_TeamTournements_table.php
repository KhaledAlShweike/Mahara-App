
<?php

use App\Models\Team;
use App\Models\Tournement;
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
        Schema::create('TeamTournements', function (Blueprint $table) {
            $table->foreignIdFor(Tournement::class)->nullable()->constrained('Tournements');
            $table->foreignIdFor(Team::class)->nullable()->constrained('Teams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TeamTournements');
    }
};
