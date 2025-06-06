<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;


class TrabajadorLocationController extends Controller
{
    public function editLocation(Trabajador $trabajador)  // Usar Route Model Binding
    {
        return view('pages.editar-trabaubi', compact('trabajador'));
    }

    public function update(Request $request, Trabajador $trabajador)
    {
        $validated = $request->validate([
            'estado' => 'required|string|max:100',
            'ciudad' => 'required|string|max:100',
            'municipio' => 'required|string|max:100',
            'calle' => 'required|string|max:200',
            'colonia' => 'required|string|max:150',
            'cp' => 'required|string|max:10',
            'numero_externo' => 'required|string|max:20',
            'numero_interno' => 'nullable|string|max:20',
            'entre_calles' => 'nullable|string|max:255'
        ]);

        $trabajador->update($validated);
        
        return redirect()->route('trabajadores.index')
               ->with('success', '¡Ubicación actualizada correctamente!');
    }
}