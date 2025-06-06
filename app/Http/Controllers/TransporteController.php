<?php

namespace App\Http\Controllers;

use App\Models\Transporte;
use App\Models\TipoTransporte;
use App\Models\ubicacion_entrega;
use App\Models\Trabajador;
use App\Models\Producto;
use App\Models\ProductosEntregados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransporteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $transportes = Transporte::with(['tipoTransporte', 'trabajador', 'ubicacionesEntrega', 'productos'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('tipoTransporte', fn($q) => $q->where('nombre', 'LIKE', "%$search%"))
                      ->orWhereHas('trabajador', fn($q) => $q->where('nombre', 'LIKE', "%$search%"))
                      ->orWhereHas('ubicacionesEntrega', fn($q) => $q->where('nombre_negocio', 'LIKE', "%$search%"))
                      ->orWhereHas('productos', fn($q) => $q->where('nombre', 'LIKE', "%$search%"));
                });
            })
            ->orderBy('fecha_salida', 'desc')
            ->paginate(5)
            ->appends(['search' => $search]);

        return view('pages.transporte', compact('transportes'));
    }

    public function create()
    {
        $tipos = TipoTransporte::all();
        $trabajadores = Trabajador::all();
        $entregas = ubicacion_entrega::all();
        $productos = Producto::all();

        return view('pages.agregar-transporte', compact('tipos', 'trabajadores', 'entregas', 'productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_salida' => 'required|date',
            'id_tipo_transporte' => 'required|exists:tipo_transporte,id_tipo_transporte',
            'modelo' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'cantidad_toneladas' => 'required|numeric|min:0',
            'id_trabajador' => 'nullable|exists:trabajador,id_trabajador',
            'ubicaciones' => 'nullable|array',
            'ubicaciones.*' => 'exists:ubicacion_entrega,id_ubicacion_entrega',
            'productos' => 'required|array',
            'productos.*' => 'exists:producto,id_producto'
        ]);

        DB::beginTransaction();

        try {
            $ubicaciones = $validated['ubicaciones'] ?? [];
            $productos = $validated['productos'];
            $cantidadToneladas = $validated['cantidad_toneladas'];
            $fechaEntrega = $validated['fecha_salida'];
            unset($validated['ubicaciones'], $validated['productos']);

            $productosModelados = Producto::whereIn('id_producto', $productos)->get();
            foreach ($productosModelados as $producto) {
                if ($producto->stockActual() < $cantidadToneladas) {
                    throw new \Exception("El producto {$producto->nombre} no tiene suficiente stock.");
                }
            }

            $transporte = Transporte::create($validated);
            $transporte->ubicacionesEntrega()->sync($ubicaciones);
            $transporte->productos()->sync($productos);

            // Registrar en productos_entregados
            foreach ($productos as $idProducto) {
                ProductosEntregados::create([
                    'id_transporte' => $transporte->id_transporte,
                    'fecha_entrega' => $fechaEntrega,
                ]);
            }

            DB::commit();

            return redirect()->route('transportes.index')->with('success', 'Transporte y entregas registrados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $transporte = Transporte::with(['tipoTransporte', 'trabajador', 'ubicacionesEntrega', 'productos'])->findOrFail($id);
        return view('pages.ver-transporte', compact('transporte'));
    }

    public function edit($id)
    {
        $transporte = Transporte::with(['productos', 'ubicacionesEntrega'])->findOrFail($id);
        $tipos = TipoTransporte::all();
        $trabajadores = Trabajador::all();
        $entregas = ubicacion_entrega::all();
        $productos = Producto::all();

        return view('pages.agregar-transporte', compact('transporte', 'tipos', 'trabajadores', 'entregas', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fecha_salida' => 'required|date',
            'id_tipo_transporte' => 'required|exists:tipo_transporte,id_tipo_transporte',
            'modelo' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'cantidad_toneladas' => 'required|numeric|min:0',
            'id_trabajador' => 'nullable|exists:trabajador,id_trabajador',
            'ubicaciones' => 'nullable|array',
            'ubicaciones.*' => 'exists:ubicacion_entrega,id_ubicacion_entrega',
            'productos' => 'required|array',
            'productos.*' => 'exists:producto,id_producto'
        ]);

        $transporte = Transporte::findOrFail($id);
        $transporte->update($validated);

        $transporte->ubicacionesEntrega()->sync($validated['ubicaciones'] ?? []);
        $transporte->productos()->sync($validated['productos']);

        return redirect()->route('transportes.index')->with('success', 'Transporte actualizado correctamente.');
    }

    public function destroy($id)
    {
        $transporte = Transporte::findOrFail($id);

        DB::beginTransaction();

        try {
            $transporte->productos()->detach();
            $transporte->ubicacionesEntrega()->detach();
            $transporte->delete();

            DB::commit();
            return redirect()->route('transportes.index')->with('success', 'Transporte eliminado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al eliminar el transporte: ' . $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $transportes = Transporte::with(['tipoTransporte', 'trabajador', 'ubicacionesEntrega', 'productos'])
            ->where(function ($q) use ($query) {
                $q->whereHas('tipoTransporte', fn($q) => $q->where('nombre', 'LIKE', "%$query%"))
                  ->orWhereHas('trabajador', fn($q) => $q->where('nombre', 'LIKE', "%$query%"))
                  ->orWhereHas('ubicacionesEntrega', fn($q) => $q->where('nombre_negocio', 'LIKE', "%$query%"))
                  ->orWhereHas('productos', fn($q) => $q->where('nombre', 'LIKE', "%$query%"));
            })
            ->get()
            ->map(function ($transporte) {
                return [
                    'id_transporte' => $transporte->id_transporte,
                    'fecha_salida' => $transporte->fecha_salida,
                    'tipoTransporte' => $transporte->tipoTransporte,
                    'trabajador' => $transporte->trabajador,
                    'ubicacionesEntrega' => $transporte->ubicacionesEntrega,
                    'productos' => $transporte->productos
                ];
            });

        return response()->json($transportes);
    }

    public function list()
    {
        $transportes = Transporte::with(['tipoTransporte', 'trabajador', 'ubicacionesEntrega', 'productos'])->get();
        return response()->json($transportes);
    }

    public function entregados(Request $request)
    {
        $fecha = $request->input('fecha');

        $entregados = ProductosEntregados::with(['transporte.trabajador', 'transporte.tipoTransporte', 'transporte.productos'])
            ->when($fecha, fn($q) => $q->whereDate('fecha_entrega', $fecha))
            ->orderBy('fecha_entrega', 'desc')
            ->get();

        return view('pages.entregados', compact('entregados'));
    }
}
