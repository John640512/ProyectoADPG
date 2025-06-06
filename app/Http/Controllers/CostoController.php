<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\historial_costo_tonelada;


class CostoController extends Controller
{
   
    public function index(Request $request)
    {
    $query = $request->input('search');
    
    $historialCostos = DB::table('historial_costo_tonelada')
        ->leftJoin('producto', 'historial_costo_tonelada.id_producto', '=', 'producto.id_producto')
        ->select('historial_costo_tonelada.*', 'producto.nombre as nombre_producto')
        ->when($query, function ($q) use ($query) {
            $q->where('producto.nombre', 'LIKE', "%{$query}%"); 
        })
        ->orderBy('fecha_registro', 'desc')
        ->paginate(5);

    return view('pages.costo', compact('historialCostos'));
    }


  
    public function create()
    {
        $productos = producto::with('tipo_producto.costoPorTonelada')->get();
        return view('pages.cambio', compact('productos'));
    }

   
   public function store(Request $request)
   {
    $request->validate([
        'fecha'           => 'required|date',
        'costo_anterior'  => 'required|numeric|min:0',
        'costo_actual'    => 'required|numeric|min:0',
        'razon_cambio'    => 'required|string',
        'producto'        => 'required|exists:producto,id_producto',
    ]);

    // Registrar en el historial
    historial_costo_tonelada::create([
        'fecha_registro'   => $request->fecha . ' ' . now()->format('H:i:s'),
        'costo_anterior'   => $request->costo_anterior,
        'costo_actual'     => $request->costo_actual,
        'razon_cambio'     => $request->razon_cambio,
        'id_producto'      => $request->producto,
    ]);

    // Obtener el producto y su tipo
    $producto = Producto::findOrFail($request->producto);
    $tipoProducto = $producto->tipo_producto;

    // Actualizar o insertar el nuevo costo en la tabla costo_por_tonelada
    DB::table('costo_por_tonelada')
        ->updateOrInsert(
            ['id_tipo_producto' => $tipoProducto->id_tipo_producto],
            ['costo_tonelada' => $request->costo_actual]
        );

    return redirect()->route('costo')->with('success', 'Cambio de costo registrado correctamente.');
    }

    public function generarPDF(Request $request)
    {
    $query = $request->input('search');

    $historialCostos = DB::table('historial_costo_tonelada')
        ->leftJoin('producto', 'historial_costo_tonelada.id_producto', '=', 'producto.id_producto')
        ->select('historial_costo_tonelada.*', 'producto.nombre as nombre_producto')
        ->when($query, function ($q) use ($query) {
            $q->where('producto.nombre', 'LIKE', "%{$query}%");
        })
        ->orderBy('fecha_registro', 'desc')
        ->get();

    // Usa la vista ubicada en resources/views/pages/costo_pdf.blade.php
    $pdf = SnappyPdf::loadView('pages.costo_pdf', compact('historialCostos'))
                    ->setPaper('a4', 'portrait');

    return $pdf->download('historial_costos.pdf');
    }
  
}