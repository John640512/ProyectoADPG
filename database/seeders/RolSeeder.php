<?php

namespace Database\Seeders;

use App\Models\rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nombre' => 'Administrador',
                'descripcion' => 'Supervisa y controla todo el sistema; tiene acceso completo para gestionar productos, stock, usuarios y generar reportes.',
            ],
            [
                'nombre' => 'Gerente de Inventarios',
                'descripcion' => 'Planifica y ajusta niveles de inventario, controla costos y reportes de existencias; no gestiona usuarios ni recursos humanos.',
            ],
            [
                'nombre' => 'Encargado de Almacén',
                'descripcion' => 'Opera directamente con el stock: registra, actualiza y elimina movimientos de inventario; marca entregas.',
            ],
            [
                'nombre' => 'Oficial de Compras',
                'descripcion' => 'Selecciona y administra proveedores y transportes; revisa niveles de stock para planificar adquisiciones.',
            ],
            [
                'nombre' => 'Coordinador de Logística',
                'descripcion' => 'Organiza destinos de entrega y medios de transporte; supervisa estado de envíos y recepciones.',
            ],
            [
                'nombre' => 'Analista de Costos / Finanzas',
                'descripcion' => 'Monitorea cambios de costos y genera reportes financieros; evalúa historial y produce PDFs de análisis.',
            ],
            [
                'nombre' => 'Gestor de Recursos Humanos',
                'descripcion' => 'Administra información del personal: altas, bajas y modificaciones; asigna roles sin crear ni eliminar usuarios.',
            ],
            [
                'nombre' => 'Auditor',
                'descripcion' => 'Revisa todas las secciones y reportes sin posibilidad de modificar datos; garantiza transparencia y cumplimiento.',
            ],
        ];

        foreach ($roles as $rol) {
            Rol::create($rol);
        }

        $this->command->info('Roles insertados correctamente!');
    }
}