<?php

use App\Models\ActorPersonalInfos;
use App\Models\Location;
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
        Schema::create('Doctors', function (Blueprint $table) {
            $table->id();
            $table->string('Location')->nullable();
            $table->string('clinic_number')->nullable();
            $table->foreignIdFor(ActorPersonalInfos::class)->nullable()->constrained('ActorPersonalInfos');
            $table->foreignIdFor(Location::class)->nullable()->constrained('Locations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Doctors');
    }
};
