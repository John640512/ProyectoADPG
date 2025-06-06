<?php

namespace Database\Seeders;

use App\Models\usuario;
use Database\Factories\UsuarioFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        usuario::factory()->count(20)->create();
    }
}
