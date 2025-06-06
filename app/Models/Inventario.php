<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';
    protected $primaryKey = 'id_inventario';

    protected $fillable = [
        'fecha_corte_semanalmente',
        'estado',
        'id_producto',
        'id_stock',
        'nivel_actual_stock',
        'nivel_minimo_stock',
    ];

    public $timestamps = false;

  protected static function booted()
{
    static::creating(function ($inventario) {
        if (empty($inventario->nivel_actual_stock)) {
            $inventario->nivel_actual_stock = '100';
        }

        // Cálculo y guardado del nivel mínimo de stock
        if (empty($inventario->nivel_minimo_stock)) {
            // Obtener el stock relacionado si se ha cargado
            if ($inventario->stock) {
                $inventario->nivel_minimo_stock = round($inventario->stock->cantidad_toneladas * 0.20, 2);
            } else {
                // Buscarlo directamente si solo está el ID
                $stock = \App\Models\Stock::find($inventario->id_stock);
                if ($stock) {
                    $inventario->nivel_minimo_stock = round($stock->cantidad_toneladas * 0.20, 2);
                }
            }
        }
    });
}

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }

   
}
