<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Recuperar Contraseña - Club de Natación</title>
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

        .invalid-feedback {
            display: block;
            color: #ff6b6b;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <h2>Recuperar Contraseña</h2>

        @if (session('status'))
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Enviar enlace</button>
        </form>
    </div>
</body>
</html>
