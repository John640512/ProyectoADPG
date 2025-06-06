<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    use HasFactory;
    
    protected $table = 'transporte';
    protected $primaryKey = 'id_transporte';
    protected $casts = ['fecha_salida' => 'datetime'];
    protected $fillable = [
        'fecha_salida',
        'color', 
        'cantidad_toneladas', 
        'modelo', 
        'id_tipo_transporte',
        'id_trabajador',
    ];

    public function tipoTransporte()
    {
        return $this->belongsTo(TipoTransporte::class, 'id_tipo_transporte');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'id_trabajador');
    }

    public function ubicacionesEntrega() 
    {
        return $this->belongsToMany(ubicacion_entrega::class, 'transporte_ubicacion_entrega', 'id_transporte', 'id_ubicacion_entrega');
    }

    public function productos() 
    {
        return $this->belongsToMany(Producto::class, 'transporte_producto', 'id_transporte', 'id_producto');
    }
    
    public $timestamps = false;
}