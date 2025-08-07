<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogout
{
    /**
     * Handle the logout event.
     */
    public function handle(Logout $event): void
    {
        // Prevenir duplicación: verificar si ya se registró este cierre
        static $hasLogged = false;

        if ($hasLogged) return;
        $hasLogged = true;

        Log::info('🔓 Cierre de sesión', [
            'id'    => $event->user->id,
            'name'  => $event->user->name,
            'email' => $event->user->email,
            'rol'   => $event->user->rol ?? 'N/A',
        ]);
    }
}
        