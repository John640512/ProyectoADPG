<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costo_por_tonelada extends Model
{
    use HasFactory;
    protected $table = 'costo_por_tonelada';
    protected $primaryKey = 'id_costo_por_tonelada';

    protected $fillable = ['costo_tonelada', 'id_proveedor', 'id_tipo_producto'];

    public function Tipo_producto()
    {
        return $this->belongsTo(tipo_producto::class, 'id_tipo_producto');
    }

    public function Proveedor()
    {
        return $this->belongsTo(proveedor::class, 'id_proveedor');
    }
    public $timestamps = false;
}

