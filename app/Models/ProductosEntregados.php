<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosEntregados extends Model
{
    use HasFactory;

    protected $table = 'productos_entregados';
    protected $primaryKey = 'id_producto_entregado';

    public $timestamps = false;

    protected $fillable = [
        'id_transporte',
        'id_producto',
        'cantidad',
        'fecha_entrega',
    ];

    public function transporte()
    {
        return $this->belongsTo(Transporte::class, 'id_transporte');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
