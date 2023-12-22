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
        Schema::create('stadium', function (Blueprint $table) {
            $table->id();
            $table->string('stadium_type');
            $table->integer('price');
            $table->float('discount');
            $table->foreignIdFor(Sport_type::class)->nullable()->constrained('sport_types');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stadium');
    }
};
