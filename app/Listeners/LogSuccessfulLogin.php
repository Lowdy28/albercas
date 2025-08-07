<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    /**
     * Handle the login event.
     */
    public function handle(Login $event): void
    {
        // Prevenir duplicación: verificar si ya se registró este inicio
        static $hasLogged = false;

        if ($hasLogged) return;
        $hasLogged = true;

        Log::info('🔐 Inicio de sesión', [
            'id'    => $event->user->id,
            'name'  => $event->user->name,
            'email' => $event->user->email,
            'rol'   => $event->user->rol ?? 'N/A',
        ]);
    }
}
