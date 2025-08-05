<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Club de Natación</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('https://img.freepik.com/fotos-premium/piscina-vacia-subacuatica_559531-13044.jpg?semt=ais_hybrid&w=740') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            color: #ffffff;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5); /* semitransparente para contraste */
            padding: 1.2rem 2rem;
        }

        .club-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffffff;
        }

        nav a {
            text-decoration: none;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #ffffff;
            margin-left: 0.5rem;
            transition: all 0.3s ease-in-out;
            border: 2px solid transparent;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #ffffff;
        }

        main {
            text-align: center;
            padding: 6rem 1rem;
        }

        h1 {
            font-size: 3rem;
            color: #ffffff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        p {
            font-size: 1.2rem;
            color: #eeeeee;
        }
    </style>
</head>

<body>
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        <div class="club-title">
            Club de Natación 🏊‍♂️
        </div>

        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main>
        <h1>Bienvenido a tu club acuático</h1>
        <p>Disfruta del mejor entrenamiento en natación y diversión en nuestras albercas.</p>
    </main>
</body>

</html>
