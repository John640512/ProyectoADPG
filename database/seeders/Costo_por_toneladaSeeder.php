<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\costo_por_tonelada;

class Costo_por_ToneladaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        costo_por_tonelada::factory()->count(20)->create();
    }
}
