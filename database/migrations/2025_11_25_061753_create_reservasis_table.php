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

    Schema::create('reservasis', function (Blueprint $table) {
        $table->bigIncrements('id_reservasi');
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_kamar');
        $table->date('tgl_checkin');
        $table->date('tgl_checkout');
        $table->enum('status_pembayaran', ['pending', 'paid', 'cancelled'])->default('pending');
        $table->timestamps();

        $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        $table->foreign('id_kamar')->references('id_kamar')->on('kamars')->onDelete('cascade');
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
