<?php

use App\Models\Image;
use App\Models\Player;
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
        Schema::create('AlterImage', function (Blueprint $table) {
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('Stadiums');
            $table->foreignIdFor(Image::class)->nullable()->constrained('Images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AlterImage');
    }
};
