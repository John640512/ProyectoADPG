<?php

namespace Database\Seeders;

use App\Models\permiso;
use App\Models\rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Rol_PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesPermisos = [
            ['id_rol' => 1, 'id_permiso' => 1],
            ['id_rol' => 2, 'id_permiso' => 2], 
            ['id_rol' => 3, 'id_permiso' => 3], 
            ['id_rol' => 4, 'id_permiso' => 4], 
            ['id_rol' => 5, 'id_permiso' => 5], 
            ['id_rol' => 6, 'id_permiso' => 6], 
            ['id_rol' => 7, 'id_permiso' => 7], 
            ['id_rol' => 8, 'id_permiso' => 8], 
            ['id_rol' => 9, 'id_permiso' => 9], 
            ['id_rol' => 10, 'id_permiso' => 10], 
            ['id_rol' => 11, 'id_permiso' => 11], 
            ['id_rol' => 12, 'id_permiso' => 12], 
            ['id_rol' => 13, 'id_permiso' => 13], 
            ['id_rol' => 14, 'id_permiso' => 14], 
            ['id_rol' => 15, 'id_permiso' => 15], 
            ['id_rol' => 16, 'id_permiso' => 16], 
            ['id_rol' => 17, 'id_permiso' => 17], 
            ['id_rol' => 18, 'id_permiso' => 18], 
            ['id_rol' => 19, 'id_permiso' => 19], 
            ['id_rol' => 20, 'id_permiso' => 20],  
        ];

        DB::table('rol_permiso')->insert($rolesPermisos);
    }
}
