<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return inertia('auth/Register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.required' => 'Debes ingresar un correo electrónico.',
            'password.required' => 'Debes ingresar una contraseña.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Encriptar la contraseña
        $data['password'] = Hash::make($data['password']);

        // Crear el usuario
        User::create($data);

        // Redirigir al login con mensaje
        return redirect()->route('login')
            ->with('success', 'Registro exitoso');
    }
}
