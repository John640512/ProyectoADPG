<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    public function run(): void
    {

    // Desactivar verificaciones de FK
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
    // Limpiar tablas relacionadas primero
    DB::table('rol_permiso')->truncate();
    DB::table('permiso')->truncate();

    // Reactivar verificaciones
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permisos = [
            [
                'nombre' => 'Crear',
                'descripcion' => 'Agregar nuevos registros (productos, proveedores, usuarios, etc.).',
            ],
            [
                'nombre' => 'Ver (o Leer)',
                'descripcion' => 'Consultar y listar datos sin modificarlos.',
            ],
            [
                'nombre' => 'Editar',
                'descripcion' => 'Modificar los campos de registros existentes.',
            ],
            [
                'nombre' => 'Eliminar',
                'descripcion' => 'Borrar registros de forma permanente.',
            ],
            [
                'nombre' => 'Asignar costo',
                'descripcion' => 'Fijar o actualizar el precio de un producto.',
            ],
            [
                'nombre' => 'Cambiar estado',
                'descripcion' => 'Marcar proceso o fecha de corte como en proceso o terminado.',
            ],
            [
                'nombre' => 'Generar PDF',
                'descripcion' => 'Exporta reportes (costos, inventarios, entregas) en formato PDF.',
            ],
            [
                'nombre' => 'Añadir transporte',
                'descripcion' => 'Crear nuevos tipos de transporte.',
            ],
            [
                'nombre' => 'Asignar rol',
                'descripcion' => 'Vincular un rol predefinido a un usuario.',
            ],
            [
                'nombre' => 'Asignar permiso',
                'descripcion' => 'Otorgar permisos específicos adicionales a un usuario.',
            ],
            [
                'nombre' => 'Eliminar usuario',
                'descripcion' => 'Erradica completamente a un usuario del sistema.',
            ],
            
        ];

        foreach ($permisos as $permiso) {
            Permiso::create($permiso);
        }

        $this->command->info('¡Permisos insertados correctamente!');
    }
}