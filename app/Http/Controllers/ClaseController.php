<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\User;

class ClaseController extends Controller
{
    // Mostrar todas las clases
    public function list()
    {
        $clases = Clase::join('users', 'classes.id_profesor', '=', 'users.id')
            ->select('classes.*', 'users.name as profesor')
            ->get();

        // Coincide con lista.blade.php
        return view('clases.lista', compact('clases'));
    }

    // Mostrar formulario para crear nueva clase
    public function index()
    {
        $clase = new Clase();
        $profesores = User::where('rol', 'Profesor')->get();

        // Coincide con nueva.blade.php
        return view('clases.nueva', compact('clase', 'profesores'));
    }

    // Crear clase directamente
    public function crear(Request $request)
    {
        Clase::create([
            'fecha' => $request->fecha,
            'id_profesor' => $request->id_profesor,
            'tipo' => $request->tipo,
            'lugares' => $request->lugares,
            'lugares_ocupados' => 0,
            'lugares_disponibles' => $request->lugares
        ]);

        // Redirige al formulario vacío para seguir creando
        return view('clases.nueva');
    }

    // Guardar o actualizar clase
    public function store(Request $request)
    {
        if ($request->id > 0) {
            $clase = Clase::find($request->id);
        } else {
            $clase = new Clase();
        }

        $clase->fecha = $request->fecha;
        $clase->id_profesor = $request->id_profesor;
        $clase->tipo = $request->tipo;
        $clase->lugares = $request->lugares;
        $clase->lugares_ocupados = $request->lugares_ocupados ?? 0;
        $clase->lugares_disponibles = $request->lugares_disponibles ?? ($clase->lugares - $clase->lugares_ocupados);
        $clase->save();

        // Redirige a la lista de clases después de guardar
        return redirect()->route('clases.lista');
    }

    // Mostrar formulario para editar clase existente
    public function edit($id)
    {
        $clase = Clase::findOrFail($id);
        $profesores = User::where('rol', 'Profesor')->get();

        // Reutiliza nueva.blade.php para editar
        return view('clases.nueva', compact('clase', 'profesores'));
    }

    // Eliminar clase
    public function destroy($id)
    {
        $clase = Clase::findOrFail($id);
        $clase->delete();

        return redirect()->route('clases.lista');
    }
}
