<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Municipio;

class TrabajadorController extends Controller
{
    // Reglas de validación para datos principales
    protected $mainValidationRules = [
        'nombre' => 'required|string|max:100',
        'apellido_paterno' => 'required|string|max:100',
        'apellido_materno' => 'nullable|string|max:100',
        'estado' => 'nullable|string|max:100',
        'municipio' => 'nullable|string|max:100',
        'calle' => 'nullable|string|max:100',
        'colonia' => 'nullable|string|max:100',
        'entre_calles' => 'nullable|string|max:100',
        'cp' => 'nullable|string|max:100',
        'numero_externo' => 'nullable|string|max:100',
        'numero_interno' => 'nullable|string|max:100',
        'telefono' => 'nullable|string|max:20',
        'correo_electronico' => 'nullable|email|max:100',
        'rfc' => 'nullable|string|max:20'
    ];

    // Método para mostrar la lista de trabajadores
    public function index()
    {
        $trabajadores = Trabajador::orderBy('nombre')->get();
        return view('pages.trabajador', compact('trabajadores'));
    }

    public function show(Trabajador $trabajador)
{
    return view('pages.show', compact('trabajador'));
}


    // Método para mostrar el formulario de creación
    public function create()
    {

        $estados = Estado::all();
        $municipios = Municipio::all(); 

        return view('pages.crear-trabajador',  compact('estados', 'municipios'));
    }

    // Método para guardar un nuevo trabajador
    public function store(Request $request)
{
    // Asegúrate de que las reglas de validación coincidan con tus campos requeridos
    $validated = $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_paterno' => 'required|string|max:100',
        'apellido_materno' => 'nullable|string|max:100',
        'estado' => 'required|string|max:100',
        'municipio' => 'required|string|max:100',
        'calle' => 'required|string|max:100',
        'colonia' => 'required|string|max:100',
        'entre_calles' => 'nullable|string|max:100',
        'cp' => 'required|string|max:10',
        'numero_externo' => 'required|string|max:20',
        'numero_interno' => 'nullable|string|max:20',
        'telefono' => 'nullable|string|max:20',
        'correo_electronico' => 'nullable|email|max:100',
        'rfc' => 'nullable|string|max:20'
    ]);

    // Crear el trabajador con los datos validados
    Trabajador::create($validated);
    
    return redirect()->route('trabajadores.index')
           ->with('success', 'Trabajador creado exitosamente');
}
    // Método para mostrar el formulario de edición
    public function edit(Trabajador $trabajador)
{
    $estados = Estado::all();
    
    // Obtener el estado actual del trabajador
    $estadoActual = Estado::where('nombre', $trabajador->estado)->first();
    
    // Obtener municipios del estado actual
    $municipios = $estadoActual ? $estadoActual->municipios : collect([]);

    return view('pages.editar-trabaubi', compact('trabajador', 'estados', 'municipios'));
}

    public function editLocation(Trabajador $trabajador)  // Usar Route Model Binding
    {
        return view('pages.editar-trabaubi', compact('trabajador'));
    }

    // Método para actualizar los datos principales
    public function update(Request $request, $id)
    {
        //dd($trabajador);
        //$validated = $request->validate($this->mainValidationRules);
        
       
        // Validación de los campos del formulario
    $val = $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_paterno' => 'required|string|max:100',
        'apellido_materno' => 'nullable|string|max:100',
        'estado' => 'nullable|string|max:100',
        'municipio' => 'nullable|string|max:100',
        'calle' => 'nullable|string|max:100',
        'colonia' => 'nullable|string|max:100',
        'entre_calles' => 'nullable|string|max:100',
        'cp' => 'nullable|string|max:100',
        'numero_externo' => 'nullable|string|max:100',
        'numero_interno' => 'nullable|string|max:100',
        'telefono' => 'nullable|string|max:20',
        'correo_electronico' => 'nullable|email|max:100',
        'rfc' => 'nullable|string|max:20',
    ]);

    

    // Buscar el trabajador
    $trabajador = Trabajador::findOrFail($id);

    // Actualizar los campos
    $trabajador->update($request->only([
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'estado',
        'municipio',
        'calle',
        'colonia',
        'entre_calles',
        'cp',
        'numero_externo',
        'numero_interno',
        'telefono',
        'correo_electronico',
        'rfc',
    ]));

    

        
        return redirect()->route('trabajadores.index')
               ->with('success', 'Datos del trabajador actualizados');
    }

        public function municipiosPorEstado($id)
{
    $municipios = Municipio::where('id_estado', $id)->get();

    return response()->json($municipios);
}


    // Método para eliminar un trabajador
    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();
        
        return redirect()->route('trabajadores.index')
               ->with('success', 'Trabajador eliminado correctamente');
    }
}