<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function getMunicipiosPorEstado($estadoId)
    {
        try {
            $municipios = Municipio::where('id_estado', $estadoId)
                ->orderBy('municipio')
                ->get(['id', 'municipio']);
            
            return response()->json($municipios);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar municipios',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}