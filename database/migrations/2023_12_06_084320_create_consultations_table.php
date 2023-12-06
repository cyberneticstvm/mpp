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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('medical_record_number')->unique();
            $table->text('medical_history')->nullable();
            $table->text('examination')->nullable();
            $table->text('investigation')->nullable();
            $table->text('advice')->nullable();
            $table->text('notes')->nullable();
            $table->text('allergic_drugs')->nullable();
            $table->enum('surgery_advised', ['yes', 'no']);
            $table->date('review_date')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
