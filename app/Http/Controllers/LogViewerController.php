<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class LogViewerController extends Controller
{
    public function verLogs()
    {
        // Ruta al archivo específico del canal 'usuarios'
        $ruta = storage_path('logs/usuarios.log');

        if (!File::exists($ruta)) {
            return "El archivo de logs de usuarios no existe.";
        }

        $contenido = File::get($ruta);

        // Separar por líneas y limitar las últimas 300
        $lineas = explode("\n", $contenido);
        $ultimasLineas = array_slice($lineas, -300);

        return response()->view('logs.ver', ['logs' => implode("\n", $ultimasLineas)]);
    }
}
