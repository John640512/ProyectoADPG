<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alerta_stock extends Model
{
    use HasFactory;
    protected $table = 'alerta_stock';
    protected $primaryKey = 'id_alerta';

    protected $fillable = ['nivel_minimo', 'notificacion', 'id_stock'];

    public function stock()
    {
        return $this->belongsTo(stock::class, 'id_stock');
    }

     public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
    public $timestamps = false;

}
