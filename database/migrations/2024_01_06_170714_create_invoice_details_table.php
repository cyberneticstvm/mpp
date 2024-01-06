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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('month')->default(0);
            $table->integer('year')->default(0);
            $table->string('slab', 10)->nullable();
            $table->string('plan', 15)->nullable();
            $table->integer('qty')->default(0);
            $table->decimal('price', 5, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
