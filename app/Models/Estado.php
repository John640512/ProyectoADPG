<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
  // Un estado tiene muchos municipios
    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'id_estado');
    }


}
