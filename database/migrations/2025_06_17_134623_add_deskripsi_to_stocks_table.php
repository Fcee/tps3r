<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('jumlah_stock');
            $table->string('gambar')->nullable()->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('gambar');
        });
    }
};
