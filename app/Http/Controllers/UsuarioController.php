<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom_usuario' => 'required|string|max:30',
            'ap_usuario' => 'required|string|max:30',
            'am_usuario' => 'required|string|max:30',
            'tel_cel_usuario' => 'required|string|max:10',
            'tel_emergencia' => 'required|string|max:10',
            'rfc' => 'required|string|max:13',
            'notas_medicas' => 'nullable|string|max:255',
        ]);

        $usuario = Usuario::create($request->all());

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }
}
