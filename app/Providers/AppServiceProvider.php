<?php

namespace App\Providers;

use App\Http\Middleware\VerificarRol;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('Administrador', function ($user) {
            return $user->rol === "Administrador";
        });


         Gate::define('Cliente', function ($user) {
            return $user->rol === "Cliente";
        });

         Gate::define('Profesor', function ($user) {
            return $user->rol === "Profesor";
        });

        Route::aliasMiddleware('rol',VerificarRol::class);
    }
}
