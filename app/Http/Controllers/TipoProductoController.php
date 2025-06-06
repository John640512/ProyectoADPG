<?php

namespace App\Http\Controllers;

use App\Models\tipo_producto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $tiposProducto = tipo_producto::when($search, function($query) use ($search) {
            return $query->where('nombre', 'like', '%'.$search.'%');
        })
        ->orderBy('id_tipo_producto', 'desc') // Usamos tu columna real de ID
        ->paginate(5);
        
        if($request->ajax()) {
            return response()->json([
                'html' => view('tipo_producto.list', compact('tiposProducto'))->render(),
                'next_page_url' => $tiposProducto->nextPageUrl()
            ]);
        }
        
        return view('dashboard.index');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:200|unique:tipo_producto',
            'descripcion' => 'nullable|string|max:200'
        ]);
        
        $tipoProducto = tipo_producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        
        return response()->json([
            'success' => true,
            'tipoProducto' => $tipoProducto
        ]);
    }

    public function update(Request $request, tipo_producto $tipoProducto)
    {

        $request->validate([
            'nombre' => 'required|string|max:200|unique:tipo_producto,nombre,'.$tipoProducto->id_tipo_producto.',id_tipo_producto',
            'descripcion' => 'nullable|string|max:200'
        ]);
        
        $tipoProducto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        
        return response()->json(['success' => true]);
    }


    public function destroy(tipo_producto $tipoProducto)
    {   
        $tipoProducto->delete();
        return response()->json(['success' => true]);
    }

    public function list()
{
    return response()->json(Tipo_Producto::all());
}

// En tu controlador (ejemplo Laravel)
public function listTiposProducto() {
    $tipos = Tipo_Producto::all(['id_tipo_producto', 'nombre']);
    return response()->json($tipos);
}

}