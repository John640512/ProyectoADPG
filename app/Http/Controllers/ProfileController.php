<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function create()
    {
        return view('pages.profile');
    }

    // En ProfileController.php
public function update(Request $request)
{
    $user = auth()->user();
    
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido_paterno' => 'required|string|max:255',
        'apellido_materno' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'correo_electronico' => 'required|email|unique:usuario,correo_electronico,'.$user->id_usuario.',id_usuario',
    ]);

    $user->update($validated);
    return back()->with('status', 'Perfil actualizado correctamente');
}

public function updatePassword(Request $request)
{
    $user = auth()->user();
    
    $validated = $request->validate([
        'password' => 'nullable|min:8|same:password_confirmation',
    ]);

    $user->update([
        'password' => bcrypt($validated['password']),
    ]);

    return back()->with('status', 'Contraseña actualizada correctamente');
}
}