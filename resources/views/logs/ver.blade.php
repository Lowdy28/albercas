<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Logs</title>
<style>
    body {
        margin: 0;
        padding: 40px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #40c4ff, #0288d1, #01579b);
        background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        color: #e1f5fe;
    }

    h1 {
        color: #ffffff;
        font-size: 36px;
        margin-bottom: 30px;
        border-bottom: 4px solid #26a69a;
        padding-bottom: 15px;
        letter-spacing: 1.5px;
        font-weight: 800;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        text-align: center;
        background: rgba(2, 136, 209, 0.4); /* más transparencia */
        border-radius: 8px;
        padding: 15px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .log-container {
        position: relative;
        max-width: 900px;
        margin: 20px auto 0 auto;
        background-color: rgba(255, 255, 255, 0.5); /* menos opaco, más transparente */
        border-radius: 15px;
        padding: 30px 35px;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 6px 20px rgba(0, 77, 128, 0.2);
        border: 3px solid #26a69a;
        backdrop-filter: blur(4px);
    }

    .log-line {
        margin-bottom: 12px;
        padding: 12px 18px;
        border-radius: 8px;
        line-height: 1.5;
        font-size: 15px;
        color: #01579b;
        font-weight: 600;
        background-color: rgba(178, 235, 242, 0.3); /* menos opaco */
        box-shadow: inset 0 0 8px rgba(129, 212, 250, 0.2);
        transition: background-color 0.3s ease;
        word-break: break-word;
    }

    .log-line.warning {
        background-color: rgba(255, 243, 224, 0.3);
        color: #8a6d0a;
        box-shadow: inset 0 0 8px rgba(251, 192, 45, 0.2);
        border-left: 6px solid #ffb300;
    }

    .log-line.error {
        background-color: rgba(255, 205, 210, 0.3);
        color: #b71c1c;
        box-shadow: inset 0 0 8px rgba(229, 115, 115, 0.2);
        border-left: 6px solid #ef5350;
    }

    .log-line.info {
        border-left: 6px solid #0288d1;
    }

    /* Scrollbar personalizado */
    ::-webkit-scrollbar {
        width: 12px;
    }
    ::-webkit-scrollbar-track {
        background: rgba(224, 247, 250, 0.3);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background-color: #26a69a;
        border-radius: 10px;
        border: 3px solid rgba(224, 247, 250, 0.3);
    }

    /* Fondo de olas sutil */
    .log-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: url('https://images.unsplash.com/photo-1519606247868-4d47b58d80a0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        opacity: 0.02; /* menos opaco */
        border-radius: 15px;
        pointer-events: none;
        z-index: 0;
    }

    .log-container > .log-line {
        position: relative;
        z-index: 1;
    }
</style>
</head>
<body>

<h1>Logs</h1>

<div class="log-container">
    @foreach(explode("\n", $logs) as $linea)
        @php
            $clase = 'info';
            $texto = strtolower($linea);
            if (str_contains($texto, 'warning')) $clase = 'warning';
            elseif (str_contains($texto, 'error') || str_contains($texto, 'exception')) $clase = 'error';
        @endphp
        <div class="log-line {{ $clase }}">
            {{ $linea }}
        </div>
    @endforeach
</div>

</body>
</html>
