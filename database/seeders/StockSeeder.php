<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    public function run()
        {

        Stock::insert([
            ['id_category' => 1, 'nama_barang' => 'Pupuk 8,5 kg', 'jumlah_stock' => 0, 'harga_satuan' => 10000],
            ['id_category' => 1, 'nama_barang' => 'Pupuk 25,5 kg', 'jumlah_stock' => 0, 'harga_satuan' => 30000],
            ['id_category' => 2, 'nama_barang' => 'Magot', 'jumlah_stock' => 0, 'harga_satuan' => 10000],
            ['id_category' => 3, 'nama_barang' => 'Lele', 'jumlah_stock' => 0, 'harga_satuan' => 20000],
        ]);
    }
}
