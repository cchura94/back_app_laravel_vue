<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validar
        $request->validate([
            "email" => "required|email|string",
            "password" => "required|string"
        ]);
        
        // verificar
        $credenciales = request(["email", "password"]);
        if(!Auth::attempt($credenciales)){
            return response()->json([
                "mensaje" => "Unauthorized"
            ], 401);
        }

        // generar token
        $usuario = $request->user();
        $tokenResult = $usuario->createToken('mi_token');
        $token = $tokenResult->plainTextToken;
        // responder
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario
        ]);
    }

    public function registro(Request $request)
    {
        // validar
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            // 'c_password' => 'required|some:password'
        ]);
        // registrar
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        // enviar los mismos a la api externa
        /*
        $defaults = array(
        CURLOPT_URL => 'http://miotroservicio.rest/api/usuario',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => ["nombre" => $request->name, "correo" => $request->email],
        );
        $ch = curl_init();
        curl_setopt_array($ch, ($defaults));
        curl_close($ch);
        // fclose($fp);
        */

        // responder
        return response()->json([
            "mensaje" => "Usuario registrado correctamente"
        ], 201);
    }

    public function perfil(Request $request)
    {
        $this->authorize("listar_cliente");
        // responder el perfil
        $usuario = $request->user();
        return response()->json($usuario);

    }

    public function logout(Request $request)
    {
        // eliminar sus tokens
        $request->user()->tokens()->delete();
        
        // responder
        return response()->json([
            "mensaje" => "Logout"
        ]);
    }

    public function listaClientes()
    {
        $this->authorize("listar_cliente");
        
    }
}
