<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ubicacion_entrega;

class Ubicacion_EntregaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ubicacion_entrega::factory()->count(20)->create();
    }
}
