<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTransporte extends Model
{
    use HasFactory;

    protected $table = 'tipo_transporte';
    protected $primaryKey = 'id_tipo_transporte';
    protected $fillable = ['nombre', 'descripcion'];
    public $timestamps = false;  // Indicas que no hay columnas created_at ni updated_at
}

?>
