<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Stock;
use Barryvdh\Snappy\Facades\SnappyPdf;


class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $estadoSeleccionado = $request->input('estado', 'P');

        $inventarios = Inventario::with([
            'producto.tipo_producto.costoPorTonelada',
            'stock'
        ])->orderBy('id_inventario', 'desc')
          ->where('estado', 'P')
          ->paginate(5);

        return view('pages.inventario', compact('inventarios'));
    }

public function store(Request $request)
{
    // Validar los datos recibidos del formulario
    $request->validate([
        'fecha_corte_semanalmente' => 'required|date',
        'estado' => 'required|string|in:P,T',
    ]);

    // Actualizar los inventarios que están en estado "P"
    Inventario::where('estado', 'P')->update([
        'fecha_corte_semanalmente' => $request->fecha_corte_semanalmente,
        'estado' => $request->estado, // normalmente será "T"
    ]);

    // Obtener los inventarios actualizados para incluir en el PDF
    $inventarios = Inventario::with('producto.tipo_producto.costoPorTonelada', 'stock')
        ->where('fecha_corte_semanalmente', $request->fecha_corte_semanalmente)
        ->get();

    // Generar el PDF con esos inventarios
    $pdf = SnappyPdf::loadView('pages.inventario_pdf', compact('inventarios'));

    // Descargar el PDF
    return $pdf->download('inventario_' . now()->format('Y_m_d') . '.pdf');
}

}
