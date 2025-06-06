<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\CrearCuentaController;
use App\Http\Controllers\Auth\AutenticarSesionController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\UbicacionProductoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UbicacionProveedorController;
use App\Http\Controllers\UbicacionEntregaController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CostoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\TipoTransporteController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\EntregadosController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\TrabajadorLocationController;
use App\Models\Municipio;
use App\Models\Estado;

// Ruta principal (página de entrada con videos)
Route::get('/', function () {
    return view('entrada.entrada');
})->name('entrada')->middleware('guest');

// Redirección desde el botón "Ingresar" (ahora apunta a /entrar en lugar de /sign-in directamente)
Route::get('/entrar', function () {
    return redirect()->route('login');
})->name('entrar');

Route::get('/inicio', function () {
    $rol = Auth::user()->id_rol;
    if ($rol == 4) return redirect('/stock');
    if ($rol == 7) return redirect('/trabajadores');
    return redirect()->route('dashboard'); // dashboard = productos.index
})->middleware('auth');


// Autenticación (guest)
Route::middleware('guest')->group(function () {
    // Registro
    Route::get('sign-up', [CrearCuentaController::class, 'create'])->name('register');
    Route::post('sign-up', [CrearCuentaController::class, 'store']);

    // Login
    Route::get('sign-in', [AutenticarSesionController::class, 'create'])->name('login');
    Route::post('sign-in', [AutenticarSesionController::class, 'store']);

    // Recuperación de contraseña
    Route::post('verify', [AutenticarSesionController::class, 'show']);
    Route::post('reset-password', [AutenticarSesionController::class, 'update'])->name('password.update');
    Route::get('verify', function () {
        return view('sessions.password.verify');
    })->name('verify');
    
    Route::get('/reset-password/{token}', function ($token) {
        return view('sessions.password.reset', ['token' => $token]);
    })->name('password.reset');
});

// Logout
Route::post('sign-out', [AutenticarSesionController::class, 'destroy'])->middleware('auth')->name('logout');

// Usuarios y Roles (adaptado de web2.php)
Route::middleware('auth')->group(function () {
Route::prefix('usuarios')->name('usuarios.')->middleware(['auth', 'role:1,7,8'])->group(function() {
    Route::get('/', [UsuariosController::class, 'index'])->name('index');
    Route::get('/nuevo', [UsuariosController::class, 'create'])->name('create');
    Route::post('/', [UsuariosController::class, 'store'])->name('store');
    Route::put('/{usuario}', [UsuariosController::class, 'update'])->name('update');
    Route::delete('/{usuario}', [UsuariosController::class, 'destroy'])->name('destroy');
    Route::get('/{usuario}/edit-rol', [UsuariosController::class, 'editRol'])->name('edit-rol');

    // Subgrupo para Roles
    Route::prefix('roles')->name('roles.')->group(function() {
        Route::get('/', [UsuariosController::class, 'getRoles'])->name('index');
    	Route::post('/', [UsuariosController::class, 'storeRole'])->name('store');
    	Route::put('/{id_rol}', [UsuariosController::class, 'updateRole'])->name('update');
    	Route::delete('/{id_rol}', [UsuariosController::class, 'destroyRole'])->name('destroy');
        Route::get('/{id_rol}/permisos', [UsuariosController::class, 'getPermissionsByRole'])->name('permisos');
        Route::delete('/{id_rol}/permisos/{id_permiso}', [UsuariosController::class, 'removePermission'])->name('remove-permission');
    });

    // Subgrupo para Permisos
    Route::prefix('permisos')->name('permisos.')->group(function() {
        Route::get('/', [UsuariosController::class, 'getAllPermissions'])->name('index');
        Route::get('/rol/{id_rol}', [UsuariosController::class, 'getRolePermissions'])->name('by-rol');
        Route::post('/asignar', [UsuariosController::class, 'assignPermission'])->name('assign');
        Route::delete('/remover/{id_rol}/{id_permiso}', [UsuariosController::class, 'removePermission'])->name('remove');
		Route::get('/{permiso}/editar', [UsuariosController::class, 'editPermission'])->name('edit');
    	Route::put('/{permiso}', [UsuariosController::class, 'updatePermission'])->name('update');
		Route::delete('/{permiso}', [UsuariosController::class, 'destroyPermission'])->name('destroy');
    });
});

Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password')->middleware('auth');
});

Route::middleware(['auth', 'role:1,2,3,5,6,8'])->group(function () {
    //Area de Productos
    Route::get('/dashboard', [ProductoController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::resource('productos', ProductoController::class);
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    //modal tipo de productos 
    Route::resource('tipo-producto', TipoProductoController::class)->except(['create', 'edit', 'show']);
    Route::delete('/tipo-producto/{id}', [TipoProductoController::class, 'destroy'])->middleware('auth');

    //modal ubicacion de productos 
    Route::resource('ubicacion-producto', UbicacionProductoController::class)->except(['create', 'edit', 'show']);
    // En routes/web.php
    Route::get('/ubicacion-producto', [UbicacionProductoController::class, 'index'])->name('ubicacion-producto.index');
    Route::post('/ubicacion-producto', [UbicacionProductoController::class, 'store'])->name('ubicacion-producto.store');
    Route::put('/ubicacion-producto/{id}', [UbicacionProductoController::class, 'update'])->name('ubicacion-producto.update');

    // Costo
    Route::post('/productos/asignar-costo-por-tipo', [ProductoController::class, 'asignarCostoPorTipo'])
        ->name('productos.asignar-costo-por-tipo');
    //buscar los productos 
    Route::get('/productos/search', [ProductoController::class, 'search'])->name('productos.search');
    Route::get('/productos/list', [ProductoController::class, 'list'])->name('productos.list');

    Route::get('agregarProducto', function () {
		return view('pages.agregarProducto');
	})->name('agregarProducto');

    Route::get('/tipo-producto/list', [TipoProductoController::class, 'list'])->name('tipo-producto.list');

});



// Perfil de usuario
Route::get('profile', [ProfileController::class, 'create'])->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->name('user-profile');
Route::group(['middleware' => 'auth'], function () {
	Route::get('stock', function () {
		return view('pages.stock');
	})->name('stock');
});

Route::middleware(['auth', 'role:1,4,8'])->group(function () {
    // Mostrar listado de proveedores
    Route::get('/proveedor', [ProveedorController::class, 'index'])->name('proveedor.index');

    // Mostrar formulario para agregar un nuevo proveedor (paso 1)
    Route::get('/proveedor/agregar', [ProveedorController::class, 'create'])->name('proveedor.agregar');

    // Guardar datos del paso 1 del proveedor (nombre, teléfono, etc.)
    Route::post('/proveedor/paso1', [ProveedorController::class, 'storePaso1'])->name('proveedor.storePaso1');

    // Mostrar formulario del paso 2: ubicación del proveedor
    Route::get('/proveedor/ubicacion', [ProveedorController::class, 'showUbicacionForm'])->name('proveedor.ubiprove');

    // Guardar ubicación del proveedor (paso 2)
    Route::post('/proveedor/ubicacion', [UbicacionProveedorController::class, 'store'])->name('proveedor.storeUbicacion');

    // Eliminar proveedor
    Route::delete('/proveedor/{id}', [ProveedorController::class, 'destroy'])->name('proveedor.destroy');

    // Rutas específicas para un proveedor en particular (por ID)
    Route::prefix('proveedor/{proveedor}')->group(function () {
        // Ver detalles de un proveedor
        Route::get('/', [ProveedorController::class, 'show'])->name('proveedor.show');

        // Editar información principal del proveedor
        Route::get('/edit', [ProveedorController::class, 'edit'])->name('proveedor.edit');

        // Actualizar información principal del proveedor
        Route::put('/', [ProveedorController::class, 'update'])->name('proveedor.update');

        // Actualizar y pasar al siguiente paso 
        Route::put('/update-next', [ProveedorController::class, 'updateAndNext'])->name('proveedor.update.next');

        // Editar ubicación del proveedor
        Route::get('/ubicacion/edit', [ProveedorController::class, 'editUbicacion'])->name('proveedor.ubicacion.edit');

        // Actualizar ubicación del proveedor
        Route::put('/ubicacion', [ProveedorController::class, 'updateUbicacion'])->name('proveedor.ubicacion.update');
    });
});

Route::middleware(['auth', 'role:1,4,5,8'])->group(function () {
    Route::get('/transporte', function () {
					return view('pages.transporte');
				})->name('transporte');
			
				Route::get('/agregar-transporte', function () {
					return view('pages.agregar-transporte');
				})->name('agregar-transporte');
			
				Route::post('/guardar-transporte', function () {
					// Lógica para guardar
					return redirect()->route('transporte');
				})->name('guardar.transporte');
			
				Route::get('/ver-transporte', function () {
					return view('pages.ver-transporte');
				})->name('ver-transporte');
			
				Route::get('/editar-transporte', function () {
					return view('pages.editar-transporte');
				})->name('editar-transporte');

// Rutas para Transporte
    Route::resource('transportes', TransporteController::class);
    Route::get('/transportes/search', [TransporteController::class, 'search'])->name('transportes.search');
    //modal tipo de transporte
    Route::resource('tipo-transporte', TipoTransporteController::class)->except(['create', 'edit', 'show']);
});
	

	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
	

// Stock 
Route::middleware(['auth', 'role:1,2,3,4,8'])->group(function () {
   Route::get('/stock', [StockController::class, 'index'])->name('stock');
   Route::get('/registrar-stock', [StockController::class, 'create'])->name('registrarStock');
   Route::post('/stock', [StockController::class, 'store'])->name('storeStock');
   Route::get('/stock/{id}/edit', [StockController::class, 'edit'])->name('stock.edit');
   Route::put('/stock/{id}', [StockController::class, 'update'])->name('stock.update');
   Route::delete('/stock/{id}', [StockController::class, 'destroy'])->name('stock.destroy');
 
});

//historial colsto tonelada
Route::middleware(['auth', 'role:1,2,6,8'])->group(function () {
    Route::get('/costo', [CostoController::class, 'index'  ])->name('costo');
    Route::get('/cambio', [CostoController::class, 'create' ])->name('cambio');
    Route::post('/costo', [CostoController::class, 'store'  ])->name('costo.store');
    Route::get('/obtener-costo/{id_producto}', [CostoController::class, 'obtenerUltimoCosto'])->name('obtener.costo');
    Route::get('/costo/generar-pdf', [CostoController::class, 'generarPDF'])->name('costo.generarPDF'); 
});


// Grupo de rutas para trabajadores
Route::middleware(['auth', 'role:1,7,8'])->group(function () {
    Route::prefix('trabajadores')->group(function () {
    // Ruta principal (lista de trabajadores)
    Route::get('/', [TrabajadorController::class, 'index'])->name('trabajadores.index');
    
    // Ruta para crear nuevo trabajador
    Route::get('/crear', [TrabajadorController::class, 'create'])->name('trabajadores.create');
    Route::post('/', [TrabajadorController::class, 'store'])->name('trabajadores.store');
    
    // Ruta para editar trabajador
    Route::get('/{trabajador}/editar', [TrabajadorController::class, 'edit'])->name('trabajadores.edit');
    Route::put('/{trabajador}', [TrabajadorController::class, 'update'])->name('trabajadores.update');
    
    // Ruta para eliminar trabajador
    Route::delete('/{trabajador}', [TrabajadorController::class, 'destroy'])->name('trabajadores.destroy');
    Route::get('/trabajadores/{trabajador}', [TrabajadorController::class, 'show'])->name('trabajadores.show');
});

// Rutas específicas para ubicación
Route::prefix('trabajadores/{trabajador}')->group(function() {
    Route::get('editar-ubicacion', [TrabajadorLocationController::class, 'edit'])
        ->name('trabajadores.ubicacion.edit');
    Route::put('actualizar-ubicacion', [TrabajadorLocationController::class, 'update'])
        ->name('trabajadores.ubicacion.update');
});

Route::get('/trabajadores/municipios-por-estado/{estado}', [MunicipioController::class, 'getMunicipiosPorEstado'])
    ->name('trabajadores.municipios.por.estado');

Route::get('/municipios-por-estado/{id}', [TrabajadorController::class, 'municipiosPorEstado']);
});
        

//Inventario
Route::middleware(['auth', 'role:1,2,6,8'])->group(function () {
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario');
    Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');
});


//Productos Entregados
Route::middleware(['auth', 'role:1,2,3,5,6,8'])->group(function () {
    Route::get('/entregados', [TransporteController::class, 'entregados'])->name('entregados');
    Route::post('/productos-entregados/actualizar-fecha', [EntregadosController::class, 'actualizarFechaEntrega'])->name('productos-entregados.actualizar-fecha');
    Route::post('/entregados/generar-pdf', [EntregadosController::class, 'generarPDF'])->name('entregados.generarPDF');
});

Route::middleware(['auth', 'role:1,5'])->group(function () {
    Route::prefix('ubicacion-entrega')->group(function () {
        // Principal
        Route::get('/', [UbicacionEntregaController::class, 'index'])->name('ubicacion_entrega');
        
        // Creación en 2 pasos
        Route::get('/agregar', [UbicacionEntregaController::class, 'createStep1'])->name('agregar-ubicacionentrega');
        Route::post('/guardar-paso1', [UbicacionEntregaController::class, 'storeStep1'])->name('guardar.paso1');
        Route::get('/agregar-paso2', [UbicacionEntregaController::class, 'createStep2'])->name('agregardatosdelnegocioubicacionentrega');
        Route::post('/guardar-paso2', [UbicacionEntregaController::class, 'storeStep2'])->name('guardar.paso2');
        
        // Visualización
       Route::get('/ver/{id}', [UbicacionEntregaController::class, 'show'])->name('verubicacionentrega');
        // Edición en 2 pasos
        Route::get('/editar/{id}', [UbicacionEntregaController::class, 'editStep1'])->name('editarubicacionentrega');
        Route::get('/editar-paso2/{id}', [UbicacionEntregaController::class, 'editStep2'])->name('editarmasdatosdeubicacionentrega');
        Route::put('/actualizar/{id}', [UbicacionEntregaController::class, 'update'])->name('actualizarubicacionentrega');
        
        // Eliminación
        Route::delete('/eliminar/{id}', [UbicacionEntregaController::class, 'destroy'])->name('eliminarubicacionentrega');
		

Route::put('/ubicacion-entrega/actualizar/{id}', [UbicacionEntregaController::class, 'update'])
    ->name('actualizarubicacionentrega');


Route::prefix('ubicacion-entrega')->group(function () {
    Route::get('/agregar', [UbicacionEntregaController::class, 'createStep1'])->name('agregar-ubicacionentrega');
    Route::post('/guardar-paso1', [UbicacionEntregaController::class, 'storeStep1'])->name('guardar.paso1');
    Route::get('/agregar-paso2', [UbicacionEntregaController::class, 'createStep2'])->name('agregardatosdelnegocioubicacionentrega');
    Route::post('/guardar-paso2', [UbicacionEntregaController::class, 'storeStep2'])->name('guardar.paso2');
    
        });
    });
});