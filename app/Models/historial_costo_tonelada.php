<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial_costo_tonelada extends Model
{
    use HasFactory;
    protected $table = 'historial_costo_tonelada';
    protected $primaryKey = 'id_historial';

    protected $fillable = ['fecha_registro', 'costo_anterior', 'costo_actual', 'razon_cambio', 'id_producto'];

    public function producto()
    {
        return $this->belongsTo(producto::class, 'id_producto');
    }
    public $timestamps = false;
}
