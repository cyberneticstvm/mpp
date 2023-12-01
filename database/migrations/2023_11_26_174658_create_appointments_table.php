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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('profile_id');
            $table->string('patient_name', 100);
            $table->date('dob')->nullable();
            $table->integer('age')->nullable();
            $table->enum('old', ['days', 'months', 'years'])->nullable();
            $table->string('mobile', 10);
            $table->string('address')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unique(['appointment_date', 'appointment_time', 'profile_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
