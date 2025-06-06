<?php

namespace Database\Seeders;

use App\Models\trasnporte;
use App\Models\ubicacion_entrega;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Transporte_Ubicacion_EntregaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transporte_ubicacionEntrega = [
            ['id_transporte' => 1, 'id_ubicacion_entrega' => 1],
            ['id_transporte' => 2, 'id_ubicacion_entrega' => 2],
            ['id_transporte' => 3, 'id_ubicacion_entrega' => 3],
            ['id_transporte' => 4, 'id_ubicacion_entrega' => 4],
            ['id_transporte' => 5, 'id_ubicacion_entrega' => 5],
            ['id_transporte' => 6, 'id_ubicacion_entrega' => 6],
            ['id_transporte' => 7, 'id_ubicacion_entrega' => 7],
            ['id_transporte' => 8, 'id_ubicacion_entrega' => 8],
            ['id_transporte' => 9, 'id_ubicacion_entrega' => 9],
            ['id_transporte' => 10, 'id_ubicacion_entrega' => 10],
            ['id_transporte' => 11, 'id_ubicacion_entrega' => 11],
            ['id_transporte' => 12, 'id_ubicacion_entrega' => 12],
            ['id_transporte' => 13, 'id_ubicacion_entrega' => 13],
            ['id_transporte' => 14, 'id_ubicacion_entrega' => 14],
            ['id_transporte' => 15, 'id_ubicacion_entrega' => 15],
            ['id_transporte' => 16, 'id_ubicacion_entrega' => 16],
            ['id_transporte' => 17, 'id_ubicacion_entrega' => 17],
            ['id_transporte' => 18, 'id_ubicacion_entrega' => 18],
            ['id_transporte' => 19, 'id_ubicacion_entrega' => 19],
            ['id_transporte' => 20, 'id_ubicacion_entrega' => 20],
        ];

        DB::table('transporte_ubicacion_entrega')->insert($transporte_ubicacionEntrega);
    }
}
