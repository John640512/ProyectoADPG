<?php

namespace App\Http\Controllers;

use App\Models\ubicacion;
use Illuminate\Http\Request;

class UbicacionProductoController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $ubicacionProductos = Ubicacion::when($search, function($query) use ($search) {
        return $query->where('nombre', 'like', '%'.$search.'%');
    })
    ->orderBy('id_ubicacion', 'desc')
    ->paginate(5, ['*'], 'page', $request->get('page'));
    
    if($request->ajax()) {
        return response()->json([
            'html' => view('ubicacion_producto.listUbicacionP', compact('ubicacionProductos'))->render(),
            'next_page_url' => $ubicacionProductos->nextPageUrl(),
            'current_page' => $ubicacionProductos->currentPage(),
            'last_page' => $ubicacionProductos->lastPage()
        ]);
    }
    
    return view('dashboard.index');
}

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:200|unique:ubicacion',
            'descripcion' => 'nullable|string|max:200'
        ]);
        
        $ubicacionProducto = ubicacion::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        
        return response()->json([
            'success' => true,
            'ubicacionProducto' => $ubicacionProducto
        ]);
    }

    public function update(Request $request, ubicacion $ubicacionProducto)
    {
        $request->validate([
            'nombre' => 'required|string|max:200|unique:ubicacion,nombre,'.$ubicacionProducto->id_ubicacion.',id_ubicacion',
            'descripcion' => 'nullable|string|max:200'
        ]);
        
        $ubicacionProducto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        
        return response()->json(['success' => true]);
    }


    public function destroy(ubicacion $ubicacionProducto)
    {
        $ubicacionProducto->delete();
        return response()->json(['success' => true]);
    }
}
