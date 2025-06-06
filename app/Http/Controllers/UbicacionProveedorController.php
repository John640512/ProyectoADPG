<?php

namespace App\Http\Controllers;

use App\Models\ubicacion_proveedor;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class UbicacionProveedorController extends Controller
{
    public function store(Request $request)
    {
        $validatedUbicacion = $request->validate([
            'estado' => 'required|string|max:200',
            'ciudad' => 'required|string|max:200',
            'municipio' => 'required|string|max:200',
            'calle' => 'required|string|max:200',
            'colonia' => 'required|string|max:200',
            'cp' => 'required|string|max:10',
            'numero_externo' => 'required|string|max:10',
            'numero_interno' => 'nullable|string|max:10'
        ]);

        $ubicacion = ubicacion_proveedor::create([
            'estado' => $validatedUbicacion['estado'],
            'ciudad' => $validatedUbicacion['ciudad'], 
            'municipio' => $validatedUbicacion['municipio'], 
            'calle' => $validatedUbicacion['calle'],
            'colonia' => $validatedUbicacion['colonia'],
            'cp' => $validatedUbicacion['cp'], 
            'numero_externo' => $validatedUbicacion['numero_externo'],
            'numero_interno' => $validatedUbicacion['numero_interno'],
        ]);

        $datosPaso1 = session()->get('proveedor_paso1');

        if (!$datosPaso1) {
            return redirect()->route('proveedor.agregar')
                 ->with('error', 'Faltan datos del paso 1');
        }

        Proveedor::create([
            'nombre' => $datosPaso1['nombre'],
            'telefono' => $datosPaso1['telefono'],
            'correo_electronico' => $datosPaso1['correo_electronico'], 
            'rfc' => $datosPaso1['rfc'],
            'id_ub_proveedor' => $ubicacion->id_ub_proveedor
        ]);

        session()->forget('proveedor_paso1');
        return redirect()->route('proveedor.index')->with('success', 'Proveedor registrado exitosamente');
    }
}