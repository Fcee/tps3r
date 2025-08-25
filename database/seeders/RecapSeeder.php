<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recap;

class RecapSeeder extends Seeder
{
    public function run()
    {
        Recap::updateRecap();
    }
}

