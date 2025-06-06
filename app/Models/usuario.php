<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;



class usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'nombre', 
        'apellido_paterno', 
        'apellido_materno', 
        'telefono', 
        'password', 
        'correo_electronico', 
        'id_rol'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getEmailForPasswordReset()
    {
        return $this->correo_electronico;
    }

    public function Rol()
    {
        return $this->belongsTo(rol::class, 'id_rol');
    }

    public $timestamps = false;

}
