<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        stock::factory()->count(20)->create();
    }
}
