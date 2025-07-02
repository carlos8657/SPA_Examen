<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\Auth\RegisterController;


// Rutas públicas (login, registro)
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');



//  Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {

    Route::get('/usuarios', function () {
        return redirect()->route('usuarios');
    });

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::resource('usuarios', UserController::class);

    Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');
    Route::resource('equipos', EquipoController::class);
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});