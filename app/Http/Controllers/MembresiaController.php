<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Membresia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use SebastianBergmann\Diff\MemoryEfficientLongestCommonSubsequenceCalculator;

class MembresiaController extends Controller
{

    public function list()
    {

        $membresias = Membresia::join('users', 'memberships.id_usuario', '=', 'users.id')
            ->select('memberships.*', 'users.name')->get();

        return
            view('membresias.lista', compact('membresias'));
    }

    public function index()
    {

        $membresia = new Membresia();

        $usuarios = User::all();
        return view('membresias.nueva', compact('usuarios', 'membresia'));
    }
    public function crear(Request $request)
    {
        Membresia::create([
            'id_usuario' => $request->id_usuario,
            'clases_adquiridas' => $request->clases_adquiridas,
            'clases_disponibles' => $request->clases_adquiridas,
            'clases_ocupadas' => 0,
        ]);
        return view('membresias.nueva');
    }

    public function store(Request $request)
    {

        if ($request->id > 0) {

            $membresia = Membresia::find($request->id);
        } else {

            $membresia = new Membresia();
        }


        $membresia->id_usuario = $request->id_usuario;
        $membresia->clases_adquiridas = $request->clases_adquiridas;
        $membresia->clases_disponibles = $request->clases_adquiridas;
        $membresia->clases_ocupadas = 0;
        $membresia->save();

        return redirect()->route('membresias');
    }





    public function edit($id)
    {


        $membresia = Membresia::findOrFail($id);
        $usuarios = User::all();

        return view('membresias.nueva', compact('usuarios', 'membresia'));
    }





    public function destroy($id)
    {
        $membresia = Membresia::findOrFail($id);
        $membresia->delete();

        return redirect()->route('membresias');
    }
}
