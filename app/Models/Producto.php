<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_registro',
        'id_tipo_producto',
        'id_ubicacion',
        'id_proveedor',
        'stock_minimo'
    ];
    
    protected $casts = [
        'fecha_registro' => 'datetime',
    ];

    public $timestamps = false;

    // Relaciones
    public function tipo_producto()
    {
        return $this->belongsTo(tipo_producto::class, 'id_tipo_producto');
    }

    public function proveedor()
    {
        return $this->belongsTo(proveedor::class, 'id_proveedor');
    }

    public function ubicacion()
    {
        return $this->belongsTo(ubicacion::class, 'id_ubicacion');
    }

    public function stock()
    {
        return $this->hasMany(stock::class, 'id_producto');
    }

    public function transportes() 
    {
        return $this->belongsToMany(Transporte::class, 'transporte_producto', 'id_producto', 'id_transporte');
    }

    // Métodos de negocio
    public function stockActual()
    {
        $entradas = $this->stock()->sum('cantidad_toneladas');

        $salidas = DB::table('transporte_producto')
            ->join('transporte', 'transporte_producto.id_transporte', '=', 'transporte.id_transporte')
            ->where('transporte_producto.id_producto', $this->id_producto)
            ->sum('transporte.cantidad_toneladas');

        return max(0, $entradas - $salidas);
    }

    public function estadoStock($stockActual = null)
    {
        $stock = $stockActual ?? $this->stockActual();
        $minimo = $this->stock_minimo ?? 10;

        if ($stock <= 0) {
            return 'sin-stock';
        } elseif ($stock <= $minimo) {
            return 'bajo-stock';
        } else {
            return 'en-stock';
        }
    }

public function nivelActualStockPorcentaje()
{
    $inventario = Inventario::where('id_producto', $this->id_producto)
                            ->where('estado', 'P') // el inventario en proceso
                            ->latest('id_inventario')
                            ->first();

    return $inventario ? $inventario->nivel_actual_stock : 0;
}




    public function estadoStockPorPorcentaje()
    {
        $porcentaje = $this->nivelActualStockPorcentaje();

        if ($porcentaje > 70) {
            return ['estado' => 'Alto', 'clase' => 'bg-gradient-success'];
        } elseif ($porcentaje <= 30) {
            return ['estado' => 'Bajo', 'clase' => 'bg-gradient-danger'];
        } else {
            return ['estado' => 'Medio', 'clase' => 'bg-gradient-warning'];
        }
    }

    public function revertirStock($cantidad)
    {
        $movimientos = Inventario::where('id_producto', $this->id_producto)
                        ->where('tipo_movimiento', 'salida')
                        ->orderBy('fecha_movimiento', 'desc')
                        ->get();

        $cantidadRestante = $cantidad;

        foreach ($movimientos as $movimiento) {
            if ($cantidadRestante <= 0) break;

            $cantidadARevertir = min($movimiento->cantidad, $cantidadRestante);

            $stock = Stock::find($movimiento->id_stock);
            $stock->cantidad_disponible += $cantidadARevertir;
            $stock->save();

            $cantidadRestante -= $cantidadARevertir;

            Inventario::create([
                'id_stock' => $stock->id_stock,
                'id_producto' => $this->id_producto,
                'tipo_movimiento' => 'entrada',
                'cantidad' => $cantidadARevertir,
                'fecha_movimiento' => now(),
                'motivo' => 'Reversión por eliminación de transporte'
            ]);
        }
    }

    public function disminuirStock($cantidad)
    {
        $this->stock = max(0, $this->stock - $cantidad);
        $this->save();
    }
}