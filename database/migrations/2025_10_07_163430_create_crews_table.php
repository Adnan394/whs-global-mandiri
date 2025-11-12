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
        Schema::create('crews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('fullname');
            $table->string('nickname');
            $table->string('phone');
            $table->string('birth_place')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('address')->nullable();
            $table->string('current_address')->nullable();
            $table->string('standby_on')->default('Offboard');
            $table->integer('is_active')->default('0');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('ktp')->nullable();
            $table->string('certificate_of_competency')->nullable();
            $table->string('certificate_of_proficiency')->nullable();
            $table->string('seaferer_medical_certificate')->nullable();
            $table->string('curriculum_vitae')->nullable();
            $table->string('additional_documents')->nullable();
            $table->foreignId('rank_id')->constrained('ranks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crews');
    }
};