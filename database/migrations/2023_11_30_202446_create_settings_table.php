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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('contact_number', 10)->nullable();
            $table->string('address')->nullable();
            $table->time('appointment_start')->nullable();
            $table->time('appointment_end')->nullable();
            $table->integer('appointment_duration')->default(0);
            $table->string('watermark_text')->nullable();
            $table->string('watermark_image')->nullable();
            $table->enum('watermark_preference', ['image', 'text', 'no'])->nullable();
            $table->string('logo')->nullable();
            $table->boolean('next_visit_followup_sms')->comment('1-yes, 0-no')->default(0);
            $table->boolean('appointment_scheduled_sms')->comment('1-yes, 0-no')->default(0);
            $table->boolean('appointment_updated_sms')->comment('1-yes, 0-no')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
