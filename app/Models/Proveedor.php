<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    protected $fillable = [
        'nombre', 
        'telefono', 
        'correo_electronico', 
        'rfc', 
        'id_ub_proveedor' 
    ];
    public $timestamps = false;
public function ubicacion_proveedor()
{
    return $this->belongsTo(Ubicacion_Proveedor::class, 'id_ub_proveedor', 'id_ub_proveedor');
}                   

    // Borrado en cascada al eliminar proveedor
    public function productos()
{
    return $this->hasMany(Producto::class, 'id_proveedor');
}
protected static function boot()
{
    parent::boot();
    static::deleting(function ($proveedor) {
        $proveedor->productos()->delete();
        $proveedor->ubicacion_proveedor()->delete();
    });
}
}



