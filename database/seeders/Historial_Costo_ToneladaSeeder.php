<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\historial_costo_tonelada;

class Historial_Costo_ToneladaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        historial_costo_tonelada::factory()->count(20)->create();
    }
}
