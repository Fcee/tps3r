<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rekap_penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id')->nullable();// Foreign key
            $table->string('nama_produk'); // Optional: redundancy
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->integer('total_harga');
            $table->string('nama_pembeli');
            $table->date('tanggal');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('status')->default('selesai');
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_penjualans');
    }
};
