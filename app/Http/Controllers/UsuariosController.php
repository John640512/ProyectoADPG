<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UsuariosController extends Controller
{

public function index(Request $request)
{
    $query = $request->input('search');
    
    $usuarios = usuario::with('Rol')
        ->when($query, function ($q) use ($query) {
            $q->where(function($q2) use ($query) {
                $q2->where('nombre', 'LIKE', "%{$query}%")
                   ->orWhere('apellido_paterno', 'LIKE', "%{$query}%")
                   ->orWhere('correo_electronico', 'LIKE', "%{$query}%")
                   ->orWhereHas('Rol', function($q3) use ($query) {
                       $q3->where('nombre', 'LIKE', "%{$query}%");
                   });
            });
        })
        ->orderBy('id_usuario', 'desc')
        ->paginate(4);

    // Debug (se mantiene igual)
    if(app()->environment('local')) {
        logger($usuarios);
    }
    
    return view('pages.laravel-examples.user-management', [
        'usuarios' => $usuarios
    ]);
}

    // Crear usuario (POST)
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:200',
        'last_name' => 'required|string|max:200',
        'mothers_last_name' => 'nullable|string|max:200',
        'phone' => 'nullable|numeric',
        'email' => 'required|email|unique:usuario,correo_electronico',
        'password' => 'required|min:8',
        'role' => 'required|exists:rol,id_rol'
    ]);

    $usuarioData = [
        'nombre' => $validated['name'],
        'apellido_paterno' => $validated['last_name'],
        'apellido_materno' => $validated['mothers_last_name'],
        'telefono' => $validated['phone'],
        'correo_electronico' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'id_rol' => $validated['role'] // Usa directamente el ID del rol seleccionado
    ];

    usuario::create($usuarioData);

    return redirect()->route('usuarios.index')->with('success', 'Usuario creado');
}

    // Agrega esto junto con los otros métodos
public function create()
    {
        return view('nuevo-usuario');
    }

    // Actualizar usuario (PUT)
public function update(Request $request, $id_usuario)
    {
        $usuario = usuario::findOrFail($id_usuario);
        
        $validated = $request->validate([
            'nombre' => 'string|max:200',
            'apellido_paterno' => 'string|max:200',
            'correo_electronico' => 'email|unique:usuario,correo_electronico,'.$id_usuario.',id_usuario',
            'id_rol' => 'exists:rol,id_rol'
        ]);

        $usuario->update($validated);
        return response()->json($usuario);
    }

    // Eliminar usuario (DELETE)
public function destroy($usuario)
{
    DB::beginTransaction();
    try {
        $user = Usuario::findOrFail($usuario);
        $user->delete();
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado correctamente'
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar usuario: ' . $e->getMessage()
        ], 500);
    }
}

    // Métodos para Roles
    public function getRoles() {
        return response()->json(Rol::all());
    }

    public function storeRole(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:200',
        'descripcion' => 'nullable|string'
    ]);

    $rol = Rol::create($validated);
    
    return response()->json([
        'success' => true,
        'message' => 'Rol creado exitosamente',
        'data' => $rol
    ]);
}

public function updateRole(Request $request, $id_rol) {
    $validated = $request->validate([
        'nombre' => 'required|string|max:200',
        'descripcion' => 'nullable|string'
    ]);

    $rol = Rol::findOrFail($id_rol);
    $rol->update($validated);
    
    return response()->json([
        'success' => true,
        'message' => 'Rol actualizado exitosamente'
    ]);
}

public function destroyRole($id_rol)
{
    DB::beginTransaction();
    try {
        // Verificar si el rol existe
        $rol = Rol::find($id_rol);
        if (!$rol) {
            return response()->json([
                'success' => false,
                'message' => 'El rol no existe'
            ], 404);
        }

        // Verificar si hay usuarios con este rol
        $userCount = Usuario::where('id_rol', $id_rol)->count();
        if ($userCount > 0) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar el rol porque está asignado a '.$userCount.' usuario(s)'
            ], 400);
        }

        // Eliminar relaciones en la tabla pivote primero
        DB::table('rol_permiso')->where('id_rol', $id_rol)->delete();

        // Finalmente eliminar el rol
        $rol->delete();

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Rol eliminado correctamente'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al eliminar rol ID '.$id_rol.': '.$e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Error interno del servidor al eliminar el rol'
        ], 500);
    }
}

// Obtener permisos asignados a un rol
public function getRolePermissions($id_rol) {
    $rol = Rol::with('permisos')->findOrFail($id_rol);
    
    return response()->json([
        'asignados' => $rol->permisos,
        'disponibles' => Permiso::whereNotIn('id_permiso', $rol->permisos->pluck('id_permiso'))->get()
    ]);
}

// Asignar permiso a rol
public function assignPermission(Request $request) {
    $validated = $request->validate([
        'id_rol' => 'required|exists:rol,id_rol',
        'id_permiso' => 'required|exists:permiso,id_permiso'
    ]);

    $rol = Rol::find($validated['id_rol']);
    $rol->permisos()->attach($validated['id_permiso']);

    return response()->json([
        'success' => true,
        'message' => 'Permiso asignado correctamente'
    ]);
}

public function removePermission($id_rol, $id_permiso)
{
    try {
        $rol = Rol::findOrFail($id_rol);
        $rol->permisos()->detach($id_permiso);
        
        return response()->json([
            'success' => true,
            'message' => 'Permiso eliminado correctamente'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar permiso: ' . $e->getMessage()
        ], 500);
    }
}

// Mostrar un permiso específico
public function getPermission($id_permiso)
{
    try {
        $permiso = Permiso::find($id_permiso);
        
        if (!$permiso) {
            return response()->json([
                'success' => false,
                'message' => 'Permiso no encontrado'
            ], 404);
        }

        return response()->json($permiso);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al recuperar el permiso'
        ], 500);
    }
}

// Mostrar formulario de edición
public function editPermission($id_permiso)
{
    $permiso = Permiso::findOrFail($id_permiso);
    return response()->json($permiso);
}

public function updatePermission(Request $request, $id_permiso)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:200|unique:permiso,nombre,'.$id_permiso.',id_permiso',
        'descripcion' => 'nullable|string|max:500'
    ]);

    $permiso = Permiso::findOrFail($id_permiso);
    $permiso->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Permiso actualizado exitosamente',
        'data' => $permiso
    ]);
}

public function editRol($id_usuario) {
    $usuario = Usuario::with('rol')->findOrFail($id_usuario);
    return response()->json([
        'usuario' => $usuario,
        'roles' => Rol::all()
    ]);
}

}