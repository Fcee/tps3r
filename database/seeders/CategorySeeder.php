<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['nama_category' => 'Pupuk 8,5 Kg', 'harga' => 10000, 'deskripsi' => 'Tidak ada deskripsi'],
            ['nama_category' => 'Pupuk 25,5 Kg', 'harga' => 30000, 'deskripsi' => 'Tidak ada deskripsi'],
            ['nama_category' => 'Magot', 'harga' => 10000, 'deskripsi' => 'Tidak ada deskripsi'],
            ['nama_category' => 'Lele', 'harga' => 20000, 'deskripsi' => 'Tidak ada deskripsi'],
        ]);        
    }
}

