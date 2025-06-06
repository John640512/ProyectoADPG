<?php

namespace App\Http\Controllers;

use App\Models\producto;
use App\Models\tipo_producto;
use App\Models\ubicacion;
use App\Models\proveedor;
use App\Models\costo_por_tonelada;
use Illuminate\Http\Request;
use App\Models\historial_costo_tonelada;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $productos = producto::with(['tipo_producto', 'ubicacion', 'tipo_producto.costoPorTonelada'])
            ->when($query, function($q) use ($query) {
                $q->where('nombre', 'LIKE', "%{$query}%");
            })
            ->orderBy('id_producto', 'desc')
            ->paginate(5); 
        
        $tiposProducto = tipo_producto::all();
        $proveedores = proveedor::all();

        return view('dashboard.index', compact('productos', 'tiposProducto', 'proveedores'));
    }

    public function create()
    {
        $tipos = tipo_producto::all();
        $ubicaciones = ubicacion::all();
        $proveedores = proveedor::all();
        
        return view('pages.agregarProducto', compact('tipos', 'ubicaciones', 'proveedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'fecha_registro' => 'required|date',
            'id_tipo_producto' => 'required|exists:tipo_producto,id_tipo_producto', 
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion', 
            'id_proveedor' => 'nullable|exists:proveedor,id_proveedor'
        ]);

        $producto = producto::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'fecha_registro' => $validated['fecha_registro'],
            'id_tipo_producto' => $validated['id_tipo_producto'],
            'id_ubicacion' => $validated['id_ubicacion'],
            'id_proveedor' => $validated['id_proveedor'] ?? null
        ]);

        $costoInicial = $producto->tipo_producto->costoPorTonelada->costo_tonelada ?? 0;
        historial_costo_tonelada::create([
            'id_producto' => $producto->id_producto,
            'costo_anterior' => 0, 
            'costo_actual' => $costoInicial,
            'razon_cambio' => 'Producto nuevo',
            'fecha_registro' => now()
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Producto creado correctamente');
    }

    public function asignarCostoPorTipo(Request $request)
    {
        $request->validate([
            'id_tipo_producto' => 'required|exists:tipo_producto,id_tipo_producto',
            'costo_tonelada' => 'required|numeric|min:0'
        ]);

        $tipoProducto = tipo_producto::find($request->id_tipo_producto);

        costo_por_tonelada::updateOrCreate(
            ['id_tipo_producto' => $request->id_tipo_producto],
            [
                'costo_tonelada' => $request->costo_tonelada,
                'id_proveedor' => null 
            ]
        );

        return response()->json([
            'message' => 'Costo por tonelada actualizado para este tipo de producto',
            'tipo_producto' => $tipoProducto->nombre
        ]);
    }

    public function show($id)
    {
        $producto = producto::with(['tipo_producto', 'ubicacion', 'proveedor'])
                            ->findOrFail($id);
        return view('pages.verProducto', compact('producto'));
    }

    public function edit($id)
    {
        $producto = producto::findOrFail($id);
        $tipos = tipo_producto::all();
        $ubicaciones = ubicacion::all();
        $proveedores = proveedor::all(); 
        
        return view('pages.agregarProducto', compact('producto', 'tipos', 'ubicaciones', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $producto = producto::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'fecha_registro' => 'required|date',
            'id_tipo_producto' => 'required|exists:tipo_producto,id_tipo_producto',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
            'id_proveedor' => 'nullable|exists:proveedor,id_proveedor'
        ]);

        $tipoProductoAnterior = $producto->tipo_producto;
        $costoAnterior = $tipoProductoAnterior->costoPorTonelada->costo_tonelada ?? 0;

        $producto->update($validated);

        $producto->refresh();
        $nuevoTipoProducto = $producto->tipo_producto;
        $nuevoCosto = $nuevoTipoProducto->costoPorTonelada->costo_tonelada ?? 0;

        if (
            $tipoProductoAnterior->id_tipo_producto !== $nuevoTipoProducto->id_tipo_producto ||
            $costoAnterior != $nuevoCosto
        ) {
            historial_costo_tonelada::create([
                'id_producto' => $producto->id_producto,
                'costo_anterior' => $costoAnterior,
                'costo_actual' => $nuevoCosto,
                'razon_cambio' => 'Actualización de producto',
                'fecha_registro' => now()
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Producto actualizado correctamente');
    }

   public function destroy($id)
   {
    $producto = producto::with('tipo_producto.costoPorTonelada')->findOrFail($id);

    // Verificar si tiene stock
    if ($producto->stock()->exists()) {
        return redirect()->back()
            ->with('error', 'No se puede eliminar el producto porque tiene stock asociado.');
    }

    // Obtener el costo actual del tipo de producto
    $costoActual = $producto->tipo_producto->costoPorTonelada->costo_tonelada ?? 0;

    // Registrar en historial antes de eliminar
    historial_costo_tonelada::create([
        'id_producto' => $producto->id_producto,
        'costo_anterior' => $costoActual,
        'costo_actual' => 0,
        'razon_cambio' => 'Producto eliminado',
        'fecha_registro' => now()
    ]);

    // Eliminar el producto
    $producto->delete();

    return redirect()->route('dashboard')
        ->with('success', 'Producto eliminado correctamente y cambio registrado en el historial.');
    }


    public function list()
    {
        $productos = producto::with(['tipo_producto', 'ubicacion', 'tipo_producto.costoPorTonelada'])->get();
        return response()->json($productos);
    }
}
