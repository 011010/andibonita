<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar el formulario
        $request->validate([
            'Usuario' => 'required',
            'Contraseña' => 'required',
        ]);

        // Verificar si el usuario y la contraseña coinciden con la base de datos
        $credentials = $request->only('Usuario', 'Contraseña');
        if (Auth::attempt($credentials)) {
            // Autenticación exitosa, redireccionar a la página deseada
            return redirect()->intended('vista');
        }

        // Autenticación fallida, redireccionar de nuevo al formulario de inicio de sesión con un mensaje de error
        return redirect()->back()->withInput()->withErrors(['Usuario' => 'Usuario o contraseña incorrectos']);
    }
}
