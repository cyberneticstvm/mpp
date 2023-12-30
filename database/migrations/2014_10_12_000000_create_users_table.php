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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile', 10)->unique();
            $table->dateTime('mobile_verified_at')->nullable();
            $table->string('otp', 6)->nullable();
            $table->string('password');
            $table->string('referral_code', 15)->unique();
            $table->enum('plan', ['free', 'basic', 'premium']);
            $table->enum('subscription', ['monthly', 'yearly']);
            $table->dateTime('plan_expired_at')->nullable();
            $table->string('password_reset_token')->nullable();
            $table->text('bio')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
