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
    Schema::create('pembayarans', function (Blueprint $table) {
        $table->bigIncrements('id_pembayaran');
        $table->unsignedBigInteger('id_reservasi');
        $table->string('metode_bayar');
        $table->integer('jumlah');
        $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
        $table->timestamps();

        $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasis')->onDelete('cascade');
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
