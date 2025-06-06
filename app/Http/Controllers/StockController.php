<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\stock;
use App\Models\producto;
use App\Models\inventario;


class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $stocks = DB::table('stock')
        ->join('producto', 'stock.id_producto', '=', 'producto.id_producto')
        ->select('stock.*', 'producto.nombre as nombre_producto')
        ->when($query, function ($q) use ($query) {
            $q->where('producto.nombre', 'LIKE', "%{$query}%");
        })
      
            ->orderBy('id_stock', 'desc') 
            ->paginate(5); 
        
        return view('pages.stock', compact('stocks'));
    }

    public function create()
    {
        $productos = producto::all();
        
        return view('pages.registrarStock', compact('productos'));
    }

   public function store(Request $request)
{
    $request->validate([
        'fecha_llegada' => 'required|date',
        'cantidad_toneladas' => 'required|numeric',
        'metodo_pago' => 'required|string',
        'id_producto' => 'required|exists:producto,id_producto', 
    ]);

    $stock = stock::create([
        'fecha_llegada' => $request->fecha_llegada,
        'cantidad_toneladas' => $request->cantidad_toneladas,
        'metodo_pago' => $request->metodo_pago,
        'id_producto' => $request->id_producto,
    ]);

    Inventario::create([
        'id_producto' => $request->id_producto,
        'id_stock' => $stock->id_stock,
        'fecha_corte_semanalmente' => null,
        'estado' => 'P',
    ]);

    return redirect()->route('stock')->with('success', 'Stock e Inventario registrados correctamente.');
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);    
        $productos = Producto::all(); 
        return view('pages.editarStock', compact('stock', 'productos'));
    }

    public function update(Request $request, $id)
    {
    $stock = Stock::findOrFail($id);

    $request->validate([
        'fecha_llegada' => 'required|date',
        'cantidad_toneladas' => 'required|numeric|min:0',
        'metodo_pago' => 'required|in:C,F,T',
        'id_producto' => 'required|exists:producto,id_producto',
    ]);

    $nuevaCantidad = $request->input('cantidad_toneladas');
    $cantidadOriginal = $stock->cantidad_toneladas;

    if ($nuevaCantidad > $cantidadOriginal) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['cantidad_toneladas' => 'La cantidad no puede ser mayor a la original (' . $cantidadOriginal . ' toneladas).']);
    }

    $stock->update($request->all());

    // Buscar el inventario relacionado
    $inventario = Inventario::where('id_stock', $stock->id_stock)->first();

    if ($inventario) {
        // Actualizar nivel actual y mínimo
        $nivelActual = ($nuevaCantidad / $cantidadOriginal) * 100;
        $inventario->nivel_actual_stock = round($nivelActual, 2);
        $inventario->nivel_minimo_stock = round($nuevaCantidad * 0.20, 2);
        $inventario->save();
    }

    return redirect()->route('stock')->with('success', 'Stock actualizado correctamente.');
    }


    public function destroy($id)
    {
    $stock = Stock::find($id);
    if ($stock) {
        $stock->delete();
        return redirect()->route('stock')->with('success', 'Stock eliminado correctamente.');
    }
    return redirect()->route('stock')->with('error', 'Stock no encontrado.');
    }


}
