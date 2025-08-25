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
            $table->string('nama_pembeli');
            $table->string('email_pembeli')->nullable(); // bisa nullable untuk opsional
            $table->unsignedBigInteger('stock_id'); // Foreign key ke tabel stocks
            $table->string('nama_barang');
            $table->integer('harga'); // harga satuan
            $table->integer('jumlah'); // jumlah produk
            $table->integer('total'); // total harga (harga * jumlah)
            $table->enum('status', ['pending', 'selesai', 'batal'])->default('pending');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
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
