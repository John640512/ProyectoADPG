<?php

namespace App\Http\Controllers;

use App\Models\TipoTransporte;
use Illuminate\Http\Request;

class TipoTransporteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $tiposTransporte = TipoTransporte::when($search, function($query) use ($search) {
            return $query->where('nombre', 'like', '%'.$search.'%');
        })
        ->orderBy('id_tipo_transporte', 'desc') // Usamos tu columna real de ID
        ->paginate(5);
        
        if($request->ajax()) {
            return response()->json([
                'html' => view('tipo_transporte.list', compact('tiposTransporte'))->render(),
                'next_page_url' => $tiposTransporte->nextPageUrl()
            ]);
        }
        
        return view('transporte.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:200|unique:tipo_transporte',
            'descripcion' => 'nullable|string|max:200'
        ]);
        
        $tipoTransporte = TipoTransporte::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        
        return response()->json([
            'success' => true,
            'tipoTransporte' => $tipoTransporte
        ]);
    }

    public function update(Request $request, TipoTransporte $tipoTransporte)
    {
        $request->validate([
            'nombre' => 'required|string|max:200|unique:tipo_transporte,nombre,'.$tipoTransporte->id_tipo_transporte.',id_tipo_transporte',
            'descripcion' => 'nullable|string|max:200'
        ]);
        
        $tipoTransporte->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);
        
        return response()->json(['success' => true]);
    }


    public function destroy(TipoTransporte $tipoTransporte)
    {
        $tipoTransporte->delete();
        return response()->json(['success' => true]);
    }
}