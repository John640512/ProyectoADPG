<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\alerta_stock;

class Alerta_StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        alerta_stock::factory()->count(20)->create();
    }
}
