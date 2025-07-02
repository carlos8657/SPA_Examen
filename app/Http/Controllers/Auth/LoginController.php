<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{

    public function show()
    {
        return inertia('auth/Login');
    }


    public function login(Request $request)
    {
        // Validar los datos del formulario de inicio de sesión
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Verificar si el usuario está activo
            if (! Auth::user()->active) {
                Auth::logout(); 

                return redirect()->route('login')->withErrors([
                    'email' => 'Tu cuenta está desactivada. Contacta al administrador.',
                ]);
            }
            $request->session()->regenerate();
            return Inertia::location(route('usuarios.index'));

        } else {
            // Si las credenciales son incorrectas, redirigir de vuelta con un mensaje de error
            return redirect()->route('login')->withErrors([
                'email' => 'Las credenciales proporcionadas no son válidas.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
