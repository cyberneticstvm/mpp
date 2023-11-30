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
            $table->integer('age');
            $table->enum('old', ['days', 'months', 'years']);
            $table->string('mobile', 10);
            $table->string('address')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->unsignedBigInteger('consultation_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unique(['appointment_date', 'appointment_time', 'profile_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('created_by')->references('id')->on('profiles');
            $table->foreign('updated_by')->references('id')->on('profiles');
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
