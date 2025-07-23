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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->unsignedBigInteger('marketing_id');
            $table->date('date');
            $table->integer('cargo_fee');
            $table->bigInteger('total_balance');
            $table->bigInteger('grand_total');
            $table->timestamps();

            $table->foreign('marketing_id')->references('id')->on('marketings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
