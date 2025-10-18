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
        Schema::create('lowongan_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('employment_type_id')->constrained('employment_types');
            $table->foreignId('experience_level_id')->constrained('experience_levels');
            $table->foreignId('rank_id')->constrained('ranks');
            $table->string('status')->default('open');
            $table->string('image');
            $table->string('slug');
            $table->string('sallary');
            $table->string('education');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_kerjas');
    }
};