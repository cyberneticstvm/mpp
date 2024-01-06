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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->integer('month')->default(0);
            $table->integer('year')->default(0);
            $table->integer('qty')->default(0);
            $table->decimal('amount', 8, 2)->default(0.00);
            $table->dateTime('due_date')->nullable();
            $table->enum('payment_status', ['pending', 'hold', 'success'])->default('pending');
            $table->string('rpay_order_id')->nullable();
            $table->string('rpay_payment_id')->nullable();
            $table->string('rpay_signature')->nullable();
            $table->dateTime('paid_date')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
