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
        Schema::create('sign_on_offs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('crew_id')->constrained('crews');
            $table->string('file')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('rank_id')->constrained('ranks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sign_on_offs');
    }
};