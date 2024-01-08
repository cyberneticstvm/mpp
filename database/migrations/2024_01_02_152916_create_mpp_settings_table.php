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
        Schema::create('mpp_settings', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->nullable();
            $table->decimal('basic_first', 5, 2)->default(0);
            $table->decimal('basic_second', 5, 2)->default(0);
            $table->decimal('basic_third', 5, 2)->default(0);
            $table->decimal('premium_first', 5, 2)->default(0);
            $table->decimal('premium_second', 5, 2)->default(0);
            $table->decimal('premium_third', 5, 2)->default(0);
            $table->integer('referral_percentage')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpp_settings');
    }
};
