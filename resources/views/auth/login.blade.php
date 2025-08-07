<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión - Club de Natación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://img.freepik.com/fotos-premium/piscina-vacia-subacuatica_559531-13044.jpg?semt=ais_hybrid&w=740') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .overlay {
            background-color: rgba(0,0,0,0.7);
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.9);
            width: 100%;
            max-width: 400px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #eee;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            text-shadow: 0 0 8px rgba(0,0,0,0.7);
        }

        label {
            color: #ddd;
            font-weight: 600;
        }

        input.form-control {
            background-color: rgba(255,255,255,0.1);
            border: 1px solid #bbb;
            color: #fff;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input.form-control:focus {
            background-color: rgba(255,255,255,0.15);
            border-color: #90caf9;
            color: #fff;
            box-shadow: 0 0 8px #90caf9;
            outline: none;
        }

        .btn-primary {
            background-color: #90caf9;
            border: none;
            width: 100%;
            font-weight: 700;
            box-shadow: 0 0 12px #90caf9;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #64b5f6;
            box-shadow: 0 0 20px #64b5f6;
            transform: scale(1.03);
        }

        .btn-google {
            background-color: #db4437;
            border: none;
            width: 100%;
            font-weight: 700;
            color: white;
            box-shadow: 0 0 12px #db4437;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-google:hover {
            background-color: #c23321;
            box-shadow: 0 0 20px #c23321;
            transform: scale(1.03);
        }

        .form-text a {
            color: #90caf9;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-text a:hover {
            text-decoration: underline;
            color: #ffffff;
        }

        .invalid-feedback {
            display: block;
            color: #ff6b6b;
            font-weight: 600;
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            color: #ccc;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background-color: #999;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Ingresar</button>

            <div class="divider">O</div>

            <a href="{{ route('google.login') }}" class="btn btn-google mb-3">
                <i class="bi bi-google"></i> Iniciar sesión con Google
            </a>

            <div class="form-text text-center mt-2">
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="form-text text-center">
                ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
            </div>
        </form>
    </div>
</body>
</html>
