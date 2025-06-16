<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Ver todos los usuarios
    public function index()
    {
        return response()->json(User::all());
    }

    // Crear nuevo usuario con email y contraseña automáticos
    public function store(Request $request)
    {
        // Validación simple
        $request->validate([
            'name' => 'required|string|max:255',
            'ap_usuario' => 'nullable|string|max:255',
            'am_usuario' => 'nullable|string|max:255',
            'tel_cel_usuario' => 'nullable|string|max:20',
            'tel_emergencia' => 'nullable|string|max:20',
            'rfc' => 'nullable|string|max:13',
            'rol' => 'required|string|max:50',
            'notas_medicas' => 'nullable|string',
        ]);

        // Crear un email automático único
        $email = strtolower(str_replace(' ', '', $request->name)) . uniqid() . '@cliente.com';

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => bcrypt('default123'), // Contraseña por defecto
            'ap_usuario' => $request->ap_usuario,
            'am_usuario' => $request->am_usuario,
            'tel_cel_usuario' => $request->tel_cel_usuario,
            'tel_emergencia' => $request->tel_emergencia,
            'rfc' => $request->rfc,
            'rol' => $request->rol,
            'notas_medicas' => $request->notas_medicas,
        ]);

        return response()->json($user, 201);
    }

    // Ver un solo usuario
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($user);
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $user->update($request->all());
        return response()->json($user);
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }
}