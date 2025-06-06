<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CrearCuentaController extends Controller
{
    public function create()
    {
        return view('auth.crearCuenta');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:200'],
            'apellido_paterno' => ['required', 'string', 'max:200'],
            'apellido_materno' => ['required', 'string', 'max:200'],
            'telefono' => ['nullable', 'numeric'],
            'correo_electronico' => ['required', 'string', 'email', 'max:200', 'unique:usuario'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $user = usuario::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono' => $request->telefono,
            'correo_electronico' => $request->correo_electronico,
            'password' => Hash::make($request->password),
            'id_rol' => 8,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
