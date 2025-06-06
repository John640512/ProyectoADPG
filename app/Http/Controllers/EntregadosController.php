<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductosEntregados;
use Barryvdh\Snappy\Facades\SnappyPdf;


class EntregadosController extends Controller
{
    public function actualizarFechaEntrega(Request $request)
    {
        $request->validate([
            'id_producto_entregado' => 'required|exists:productos_entregados,id_producto_entregado',
            'fecha_entrega' => 'required|date',
        ]);

        $producto = ProductosEntregados::findOrFail($request->id_producto_entregado);
        $producto->fecha_entrega = $request->fecha_entrega;
        $producto->save();

        return response()->json(['success' => true, 'message' => 'Fecha actualizada correctamente']);
    }

    public function generarPDF(Request $request)
{
    $request->validate([
        'fecha_entrega' => 'required|date',
    ]);

    $fecha = $request->fecha_entrega;

    // Actualizar todos los registros sin fecha
    \App\Models\ProductosEntregados::whereNull('fecha_entrega')->update(['fecha_entrega' => $fecha]);

    // Obtener todos los registros con esa fecha
    $entregados = \App\Models\ProductosEntregados::with([
        'transporte.trabajador',
        'transporte.tipoTransporte',
        'transporte.productos'
    ])
    ->whereDate('fecha_entrega', $fecha)
    ->get();

    // Generar PDF
    $pdf = SnappyPdf::loadView('pages.entregados_pdf', compact('entregados', 'fecha'));

    return $pdf->download("productos_entregados_{$fecha}.pdf");
    }

    public function index()
{
    $entregados = ProductosEntregados::with([
        'transporte.trabajador',
        'transporte.tipoTransporte',
        'transporte.productos',
        'transporte.ubicacionesEntrega', // Asegúrate de tener esta relación en el modelo Transporte
    ])->get();

    return view('pages.entregados', compact('entregados'));
}


}
