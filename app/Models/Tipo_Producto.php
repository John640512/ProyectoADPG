<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_producto extends Model
{
    use HasFactory;

    protected $table = 'tipo_producto';
    protected $primaryKey = 'id_tipo_producto';
    protected $fillable = ['nombre', 'descripcion'];
    public $timestamps = false;


    public function costoPorTonelada()
    {
        return $this->hasOne(costo_por_tonelada::class, 'id_tipo_producto');
    }
}