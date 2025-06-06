<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;

    protected $table = 'stock';
    protected $primaryKey = 'id_stock';
    public $timestamps = false;

    protected $fillable = [
        'fecha_llegada',
        'cantidad_toneladas',
        'metodo_pago',
        'id_producto'
    ];

    public function producto()
    {
        return $this->belongsTo(producto::class, 'id_producto');
    }

}
