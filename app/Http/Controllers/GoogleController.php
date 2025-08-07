<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // Redirigir al usuario a Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Manejar la respuesta de Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Buscar o crear el usuario
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(Str::random(16)), // contraseña aleatoria
                    'email_verified_at' => now(),
                ]
            );

            // Iniciar sesión
            Auth::login($user);

            // Redirigir a la página de inicio o dashboard
            return redirect()->intended('/home');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'No se pudo iniciar sesión con Google.');
        }
    }
}
