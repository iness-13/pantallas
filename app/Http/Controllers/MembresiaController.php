<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ← Importación añadida

class MembresiaController extends Controller
{
    // ✅ Listar todas las membresías con los datos del usuario relacionado
    public function index()
{
    $membresias = Membresia::with('user:id,name')->get(); // Incluye usuario (solo id y nombre)
    return response()->json($membresias);
}


    // Mostrar una por ID
    public function show($id)
    {
        $membresia = Membresia::with('user')->find($id);
        if ($membresia) {
            return response()->json($membresia);
        } else {
            return response()->json(['mensaje' => 'Membresia no encontrada'], 404);
        }
    }

    // Crear
    public function store(Request $request)
    {
        $request->validate([
            'tipo_membresia' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $membresia = new Membresia();
        $membresia->tipo_membresia = $request->tipo_membresia;
        $membresia->fecha_inicio = $request->fecha_inicio;
        $membresia->fecha_fin = $request->fecha_fin;
        $membresia->save();

        return response()->json($membresia, 201);
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $membresia = Membresia::find($id);
        if (!$membresia) {
            return response()->json(['mensaje' => 'Membresia no encontrada'], 404);
        }

        $membresia->update($request->all());
        return response()->json($membresia);
    }

    // Eliminar
    public function destroy($id)
    {
        $membresia = Membresia::find($id);
        if (!$membresia) {
            return response()->json(['mensaje' => 'Lo sentimos tu membresia no fue encontrada'], 404);
        }

        $membresia->delete();
        return response()->json(['mensaje' => 'Tu Membresia ha sido eliminada']);
    }
}
