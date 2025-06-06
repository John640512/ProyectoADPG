<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion_Proveedor extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'ubicacion_proveedor';
    protected $primaryKey = 'id_ub_proveedor';
    protected $fillable = [
        'estado', 
        'ciudad', 
        'municipio', 
        'calle', 
        'colonia', 
        'cp', 
        'numero_externo', 
        'numero_interno'
    ];
}