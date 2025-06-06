<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    // Configuración básica del modelo
    protected $table = 'trabajador';
    protected $primaryKey = 'id_trabajador'; // Clave primaria personalizada
    public $timestamps = false; // Deshabilitar timestamps

    // Métodos para compatibilidad con rutas
    public function getKeyName()
    {
        return 'id_trabajador';
    }

    public function getRouteKeyName()
    {
        return 'id_trabajador';
    }

    // Atributos asignables masivamente
    protected $fillable = [
        // Datos personales
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'correo_electronico',
        'rfc',
        
        // Datos de ubicación
        'estado',
        'ciudad',
        'municipio',
        'calle',
        'colonia',
        'entre_calles',
        'cp', // Código postal
        'numero_externo',
        'numero_interno'
    ];

    // Relaciones (si las tienes, ejemplo)
    /*
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
    */

    // Accesores (opcional)
    /*
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }
    */

    // Mutadores (opcional)
    /*
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucfirst(strtolower($value));
    }
    */
}