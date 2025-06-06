<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ubicacion_entrega extends Model
{
    protected $table = 'ubicacion_entrega';
    protected $primaryKey = 'id_ubicacion_entrega';
    protected $fillable = [
        'nombre_negocio',
        'descripcion_lugar',
        'estado',
        'calle',
        'colonia',
        'entre_calles',
        'cp',
        'numero_externo',
        'numero_interno'
    ];
    public $timestamps = false;
}