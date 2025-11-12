<?php

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
        Schema::create('crew_rotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crew_id')->constrained('crews');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('duration');
            $table->string('file')->nullable();
            $table->foreignId('ship_id')->constrained('ships')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crew_rotations');
    }
};