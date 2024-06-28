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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('user_id');
            $table->date('payment_date');
            $table->string('payment_mode', 100);
            $table->unsignedBigInteger('plan_id');
            $table->decimal('amount', 10, 2);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('plan_id')->on('plans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};