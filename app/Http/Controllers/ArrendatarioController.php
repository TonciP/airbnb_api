<?php

namespace App\Http\Controllers;

use App\Models\Arrendatario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ArrendatarioController extends Controller
{
    function login(Request $request)
    {
        $user = Arrendatario::where('email', $request->email)->first();
        if ($user === null) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Contraseña incorrecta'], 401);
        }
        return response()->json($user);
    }

    function save(Request $request)
    {
        $request->validate([
            'nombrecompleto' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'telefono' => 'required|string',
        ]);

        $arrendatario = new Arrendatario();
        $arrendatario->nombrecompleto = $request->nombrecompleto;
        $arrendatario->email = $request->email;
        $arrendatario->password = Hash::make($request->password);
        $arrendatario->telefono = $request->telefono;
        $arrendatario->save();
        return response()->json($arrendatario);

    }
}
