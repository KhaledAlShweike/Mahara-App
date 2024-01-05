<?php

use App\Models\ActorPersonalInfos;
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
            $table->string('Location');
            $table->string('clinic_number');
            $table->foreignIdFor(ActorPersonalInfos::class)->nullable()->constrained('ActorPersonalInfos');

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
