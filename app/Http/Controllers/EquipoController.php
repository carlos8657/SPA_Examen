<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();

        return Inertia::render('equipos/Index', [
            'equipos' => $equipos,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_equipo' => ['required', 'string', 'max:255'],
            'tipo_motor' => ['required', 'string', 'max:255'],
            'fecha_fabricacion' => ['required', 'date'],
            'potencia_kw' => ['required', 'numeric'],
            'velocidad_rpm' => ['required', 'integer'],
        ]);

        Equipo::create($request->only([
            'nombre_equipo',
            'tipo_motor',
            'fecha_fabricacion',
            'potencia_kw',
            'velocidad_rpm',
        ]));

        return redirect()->route('equipos.index')->with('success', 'Equipo creado correctamente.');
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'nombre_equipo' => ['required', 'string', 'max:255'],
            'tipo_motor' => ['required', 'string', 'max:255'],
            'fecha_fabricacion' => ['required', 'date'],
            'potencia_kw' => ['required', 'numeric'],
            'velocidad_rpm' => ['required', 'integer'],
        ]);

        $equipo->update($request->only([
            'nombre_equipo',
            'tipo_motor',
            'fecha_fabricacion',
            'potencia_kw',
            'velocidad_rpm',
        ]));

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado.');
    }
}
