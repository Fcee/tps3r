<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallerie;
use App\Models\Category;

class GallerieSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first();

        if ($category) {
            Gallerie::create([
                'id_category' => $category->id,
            ]);
        }
    }
}
