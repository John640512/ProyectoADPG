<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\ubicacion_proveedor; 
use App\Models\Proveedor;
use App\Models\Estado;
use App\Models\Municipio;


class ProveedorController extends Controller
{
  public function index(Request $request)
{
    $query = $request->input('search');
    
    $proveedores = Proveedor::with('ubicacion_proveedor')
                    ->when($query, function($q) use ($query) {
                        $q->where('nombre', 'LIKE', "%{$query}%");
                    })
                    ->orderBy('id_proveedor', 'desc')
                    ->paginate(5);
    
    return view('pages.proveedor', compact('proveedores'));
}

    public function create()
    {
        // Obtén los datos de la sesión 
        $datos = session('proveedor_paso1');
    
        // Regresa la vista con los datos pasados a la vista
        return view('pages.agregar', compact('datos'));
    }
    
    public function storePaso1(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:200',
        'telefono' => 'required|numeric',
        'correo_electronico' => 'required|email',
        'rfc' => 'nullable|string|max:13'
    ]);
    
    session(['proveedor_paso1' => $validated]);
    
    Log::info('Datos paso 1 guardados en sesión:', ['datos' => $validated]);
    
    return redirect()->route('proveedor.ubiprove');
}

public function showUbicacionForm()
{
    if (!session()->has('proveedor_paso1')) {
        return redirect()->route('proveedor.agregar')
             ->with('error', 'Por favor complete primero los datos básicos');
    }
    
    $estados = Estado::orderBy('nombre')->get();
    $municipios = Municipio::orderBy('municipio')->get(); 
    return view('pages.ubiprove', compact('estados','municipios')); 

   
}
//municipio y estado
public function show($id)
{
    $proveedor = Proveedor::with('ubicacion_proveedor')->findOrFail($id);
    return view('pages.ver-provee', compact('proveedor'));
}
      public function edit(Proveedor $proveedor)
    {
        return view('pages.edit-agregar', compact('proveedor'));
    }

    public function updateAndNext(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:200',
            'telefono' => 'required|numeric',
            'correo_electronico' => 'required|email',
            'rfc' => 'nullable|string|max:13'
        ]);
    
        $proveedor->update($validated);
    
        return redirect()->route('proveedor.ubicacion.edit', $proveedor)
               ->with('success', 'Datos básicos guardados correctamente');
    }
  public function editUbicacion(Proveedor $proveedor)
{
    $proveedor->loadMissing('ubicacion_proveedor');
    
    $estados = Estado::all();
    $municipios = Municipio::all();

    return view('pages.edit-ubi', compact('proveedor', 'estados', 'municipios'));
}

    
    public function updateUbicacion(Request $request, Proveedor $proveedor)
{
    $validated = $request->validate([
        'estado' => 'required|string|max:255',
        'ciudad' => 'required|string|max:255',
        'municipio' => 'nullable|string|max:255',
        'calle' => 'required|string|max:255',
        'colonia' => 'required|string|max:255',
        'cp' => 'required|string|max:10',
        'numero_externo' => 'required|string|max:10',
        'numero_interno' => 'nullable|string|max:10',
    ]);


    if ($proveedor->ubicacion_proveedor) {
        $proveedor->ubicacion_proveedor->update($validated);
    } else {
        $proveedor->ubicacion_proveedor()->create($validated);
    }

    return redirect()->route('proveedor.index')
           ->with('success', 'Actualización realizada con éxito');
}

public function destroy($id)
{
    $proveedor = Proveedor::withCount('productos')->with('ubicacion_proveedor')->findOrFail($id);

    if ($proveedor->productos_count > 0) {
        return redirect()->route('proveedor.index')
             ->with('error', 
             '⚠️ No se puede eliminar el proveedor. 
             Primero elimine los '.$proveedor->productos_count.' productos asociados.');
    }
    try {
        if ($proveedor->ubicacion_proveedor) {
            $proveedor->ubicacion_proveedor->delete();
        }
        $proveedor->delete();

        return redirect()->route('proveedor.index')
            ->with('success', 'Proveedor y ubicación eliminados correctamente');
             
    } catch (\Exception $e) {
        return redirect()->route('proveedor.index')
            ->with('error', ' Error al eliminar: '.$e->getMessage());
    }
}
}
