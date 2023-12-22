<?php

use App\Models\Club;
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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->foreignIdFor(Club::class)->nullable()->constrained();
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('stadium');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
