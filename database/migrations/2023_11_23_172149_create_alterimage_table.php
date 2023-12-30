<?php

use App\Models\Image;
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
        Schema::create('alterimage', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Player::class)->nullable()->constrained();
            $table->foreignIdFor(Image::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alterimage_');
    }
};
