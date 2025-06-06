<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ubicacion_entrega;
use App\Models\Estado;

class UbicacionEntregaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
         $ubicaciones = ubicacion_entrega::when($query, function($q) use ($query) {
        $q->where(function ($subquery) use ($query) {
            $subquery->where('estado', 'LIKE', "%{$query}%")
                     ->orWhere('nombre_negocio', 'LIKE', "%{$query}%");
        });

        })
        ->orderBy('nombre_negocio')
        ->paginate(5);

        return view('pages.ubicacion_entrega', compact('ubicaciones'));
    }

    public function createStep1()
    {
        return view('pages.agregar-ubicacionentrega');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:200',
            'descripcion_lugar' => 'required|string|max:350'
        ]);

        session(['ubicacion_paso1' => $request->only(['nombre', 'descripcion_lugar'])]);

        return redirect()->route('agregardatosdelnegocioubicacionentrega');
    }

    public function createStep2()
    {
        if (!session()->has('ubicacion_paso1')) {
            return redirect()->route('agregar-ubicacionentrega')
                ->with('error', 'Por favor complete primero los datos del negocio');
        }

        $estados = Estado::orderBy('nombre')->get();

        return view('pages.agregardatosdelnegocioubicacionentrega', compact('estados'));
    }

 public function storeStep2(Request $request)
{
    $validator = Validator::make($request->all(), [
        'estado' => 'required|string|max:200',
        'ciudad' => 'required|string|max:200',
        'calle' => 'required|string|max:200',
        'colonia' => 'required|string|max:200',
        'entre_calles' => 'required|string|max:200',
        'codigo_postal' => 'required|string|max:13',
        'numero_externo' => 'required|string|max:10',
        'numero_interno' => 'nullable|string|max:10'
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Por favor complete todos los campos requeridos');
    }

    try {
        // Verificar que los datos del paso 1 existen en sesión
        if (!session()->has('ubicacion_paso1')) {
            return redirect()->route('agregar-ubicacionentrega')
                ->with('error', 'Sesión expirada. Por favor complete los datos del negocio nuevamente');
        }

        $paso1Data = session('ubicacion_paso1');
        
        // Crear registro combinando datos de ambos pasos
        $ubicacion = ubicacion_entrega::create([
            'nombre_negocio' => $paso1Data['nombre'],
            'descripcion_lugar' => $paso1Data['descripcion_lugar'],
            'estado' => $request->estado,
            'municipio' => $request->ciudad,
            'calle' => $request->calle,
            'colonia' => $request->colonia,
            'entre_calles' => $request->entre_calles,
            'cp' => $request->codigo_postal,
            'numero_externo' => $request->numero_externo,
            'numero_interno' => $request->numero_interno ?? null
        ]);

        // Limpiar sesión
        session()->forget('ubicacion_paso1');

        return redirect()->route('ubicacion_entrega')
            ->with('success', '¡Ubicación registrada exitosamente!');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error al guardar: ' . $e->getMessage())
            ->withInput();
    }
}
    public function show($id)
    {
        $ubicacion = ubicacion_entrega::findOrFail($id);
        return view('pages.verubicacionentrega', compact('ubicacion'));
    }

    public function editStep1($id)
    {
        $ubicacion = ubicacion_entrega::findOrFail($id);
        return view('pages.editarubicacionentrega', compact('ubicacion'));
    }

    public function editStep2($id)
    {
        $ubicacion = ubicacion_entrega::findOrFail($id);
        $estados = Estado::orderBy('nombre')->get();  
        return view('pages.editarmasdatosdeubicacionentrega', compact('ubicacion', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:200',
            'descripcion_lugar' => 'required|string|max:350',
            'estado' => 'required|string|max:200',
            'ciudad' => 'required|string|max:200',
            'calle' => 'required|string|max:200',
            'colonia' => 'required|string|max:200',
            'entre_calles' => 'required|string|max:200',
            'codigo_postal' => 'required|string|max:13',
            'numero_externo' => 'required|string|max:10',
            'numero_interno' => 'nullable|string|max:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $ubicacion = ubicacion_entrega::findOrFail($id);
            
            $ubicacion->update([
                'nombre_negocio' => $request->nombre,
                'descripcion_lugar' => $request->descripcion_lugar,
                'estado' => $request->estado,
                'municipio' => $request->ciudad,
                'calle' => $request->calle,
                'colonia' => $request->colonia,
                'entre_calles' => $request->entre_calles,
                'cp' => $request->codigo_postal,
                'numero_externo' => $request->numero_externo,
                'numero_interno' => $request->numero_interno
            ]);

            return redirect()->route('ubicacion_entrega')
                ->with('success', '¡Ubicación actualizada correctamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $ubicacion = ubicacion_entrega::findOrFail($id);
            $ubicacion->delete();

            return redirect()->route('ubicacion_entrega')
                ->with('success', 'Ubicación eliminada correctamente');

        } catch (\Exception $e) {
            return redirect()->route('ubicacion_entrega')
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}