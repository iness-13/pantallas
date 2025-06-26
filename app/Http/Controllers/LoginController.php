<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
{
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        $token = $user->createToken('app')->plainTextToken;

        $user->load('membresia'); // Carga la relación

        $arr = array(
            'acceso' => "OK",
            'error' => "",
            'token' => $token,
            'idUsuario' => $user->id,
            'nombreUsuario' => $user->name,
            'rol' => $user->rol,
            'membresia' => $user->membresia // Este es el objeto completo
        );

        return response()->json($arr);
    } else {
        return response()->json([
            'acceso' => "",
            'token' => "",
            'error' => "No existe el usuario y/o contraseña",
            'idUsuario' => 0,
            'nombreUsuario' => ''
        ]);
    }
}
}