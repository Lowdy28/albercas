<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Clase;
use App\Models\Membresia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalUsuarios = 0;
        $totalProfesores = 0;
        $totalClientes = 0;
        $totalClases = 0;
        $meses = [];
        $pagosPorMes = [];
        $totalClasesProfesor = 0;
        $membresia = null;
        $clasesProfe = collect();

        if ($user->rol === 'Administrador') {
            $totalUsuarios = Usuario::count();
            $totalProfesores = Usuario::where('rol', 'Profesor')->count();
            $totalClientes = Usuario::where('rol', 'Cliente')->count();
            $totalClases = Clase::count();
        }

        if ($user->rol === 'Profesor') {
            $totalClasesProfesor = Clase::where('id_profesor', $user->id)->count();
            $clasesProfe = Clase::where('id_profesor', $user->id)
                                ->whereDate('fecha', '>=', now())
                                ->orderBy('fecha')
                                ->get();
        }

        if ($user->rol === 'Cliente') {
            $membresia = Membresia::where('id_usuario', $user->id)->first();
        }

        return view('home', compact(
            'totalUsuarios',
            'totalProfesores',
            'totalClientes',
            'totalClases',
            'meses',
            'pagosPorMes',
            'totalClasesProfesor',
            'clasesProfe',
            'membresia'
        ));
    }
}
