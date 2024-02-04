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
        Schema::create('lelang', function (Blueprint $table) {
            $table->id('id_lelang');
            $table->unsignedBigInteger('id_barang');
            $table->date('tanggal_lelang');
            $table->bigInteger('harga_awal');
            $table->bigInteger('harga_akhir');
            $table->unsignedBigInteger('id_user');
            $table->enum('status', ['dibuka', 'ditutup']);

            // Foreign key constraints
            $table->foreign('id_barang')->references('id_barang')->on('barang');
            $table->foreign('id_user')->references('id')->on('users');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lelang');
    }
};
