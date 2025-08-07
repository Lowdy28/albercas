<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Club de Natación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        :root {
            --main-red: #E57373;
            --main-red-light: #f2b5b5;
            --main-red-shadow: rgba(229, 115, 115, 0.6);
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://img.freepik.com/fotos-premium/piscina-vacia-subacuatica_559531-13044.jpg?semt=ais_hybrid&w=740') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            overflow-x: hidden;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.65);
            min-height: 100%;
            display: flex;
            flex-direction: column;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        nav.navbar {
            background-color: rgba(0, 0, 0, 0.75) !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.8);
            transition: background-color 0.3s ease;
            z-index: 1050;
        }
        nav.navbar:hover {
            background-color: rgba(229, 115, 115, 0.85) !important;
        }
        .navbar-brand {
            font-weight: 900;
            font-size: 1.6rem;
            letter-spacing: 2px;
            transition: color 0.3s ease;
            color: #ddd;
        }
        .navbar-brand:hover {
        }
        .nav-link {
            color: #ddd !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #fff !important;
            text-shadow: none !important;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fadeInUp {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .fadeInUp.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .welcome-text {
            max-width: 960px;
            margin: 1rem auto 3rem;
            text-align: center;
            color: #eee;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.8);
        }
        .welcome-text h1 {
            font-weight: 800;
            font-size: 3.5rem;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }
        .welcome-text p {
            font-size: 1.4rem;
            max-width: 650px;
            margin: 0 auto;
            color: #ddd;
            text-shadow: 0 0 8px rgba(0,0,0,0.9);
        }

        .carousel-inner img {
            height: 420px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.8);
            transition: transform 0.6s ease;
        }
        .carousel-item.active img {
            transform: scale(1.05);
            filter: brightness(1.1);
        }
        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 0 10px var(--main-red-shadow);
            transition: background 0.3s ease;
        }
        .carousel-caption h5 {
            font-weight: 700;
            font-size: 1.7rem;
            color: #ddd;
            text-shadow: 1px 1px 6px rgba(0,0,0,0.7);
        }
        .carousel-caption p {
            font-size: 1.1rem;
            color: #f0f0f0;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: drop-shadow(0 0 3px var(--main-red));
            transition: filter 0.3s ease;
        }
        .carousel-control-prev:hover .carousel-control-prev-icon,
        .carousel-control-next:hover .carousel-control-next-icon {
            filter: drop-shadow(0 0 8px var(--main-red));
        }

        .features-section {
            background-color: rgba(0, 0, 0, 0.75);
            border-radius: 12px;
            margin: 2rem auto 3rem;
            max-width: 960px;
            padding: 3rem 3.5rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.8);
            border: none;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        .feature {
            text-align: center;
            margin-bottom: 2.5rem;
            padding: 0 1rem;
            width: 280px;
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .feature i {
            font-size: 3.8rem;
            color: var(--main-red);
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 5px var(--main-red));
            transition: transform 0.3s ease;
        }
        .feature:hover i {
            transform: scale(1.15);
            color: var(--main-red-light);
            filter: drop-shadow(0 0 12px var(--main-red-light));
            cursor: default;
        }
        .feature h3 {
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.6rem;
            color: #ddd;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
        }
        .feature p {
            font-size: 1.15rem;
            line-height: 1.6;
            color: #eee;
        }

        .privacy-section {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 12px;
            margin: 2rem auto 3rem;
            max-width: 960px;
            padding: 3rem 3.5rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.8);
            border: none;
            font-size: 1.1rem;
            line-height: 1.7;
            color: #eee;

            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        .privacy-section h2 {
            color: #ddd;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 6px rgba(0,0,0,0.7);
        }
        .privacy-section p {
            margin-bottom: 1rem;
        }
        .privacy-section small {
            color: #bbb;
            font-style: italic;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 3rem 2rem 2rem;
            color: #ccc;
            font-size: 0.95rem;
            margin-top: auto;
            text-align: center;
            box-shadow: 0 -4px 20px var(--main-red-shadow);
            user-select: none;
        }
        footer a {
            color: #85b6ff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        footer a:hover {
            color: var(--main-red);
            text-decoration: underline;
        }
        .contact-info,
        .footer-links,
        .social-icons,
        .footer-legal {
            margin-bottom: 1.3rem;
        }
        .contact-info p, .footer-links a {
            margin: 0.3rem 0;
            font-weight: 500;
        }
        .social-icons a {
            margin: 0 0.7rem;
            color: #85b6ff;
            font-size: 1.7rem;
            transition: color 0.3s ease;
        }
        .social-icons a:hover {
            color: var(--main-red);
        }

        .btn-outline-light {
            border-color: var(--main-red);
            color: var(--main-red);
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-outline-light:hover {
            background-color: var(--main-red);
            color: #fff;
            border-color: var(--main-red);
            box-shadow: 0 0 12px var(--main-red);
        }

        @media (max-width: 768px) {
            .welcome-text h1 {
                font-size: 2.5rem;
            }
            .welcome-text p {
                padding: 0 1rem;
            }
            .carousel-inner img {
                height: 280px;
            }
            .feature {
                width: 100%;
                max-width: 320px;
                margin: 0 auto 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="overlay d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">🏊 Club de Natación</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Ir al Sistema</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="welcome-text fadeInUp">
            <h1>Bienvenido al Club de Natación</h1>
            <p>Donde cada brazada cuenta. Gestiona tus clases, membresías y progreso con nuestro sistema.</p>
        </div>

        <div id="classTypesCarousel" class="carousel slide mx-auto" data-bs-ride="carousel" style="max-width: 960px; margin-bottom: 2rem;">
            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/media/niños.webp') }}" class="d-block w-100" alt="Clases Infantiles" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Clases Infantiles</h5>
                        <p>Diseñadas especialmente para niños, con enfoque en la seguridad y la diversión.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/media/adu.JPG') }}" class="d-block w-100" alt="Clases para Adultos" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Clases para Adultos</h5>
                        <p>Entrenamiento personalizado para todas las edades y niveles.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/media/compe.jpg') }}" class="d-block w-100" alt="Clases para Competencia" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Clases para Competencia</h5>
                        <p>Preparación intensiva para nadadores que buscan competir a nivel profesional.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#classTypesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#classTypesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        <section class="features-section text-white">
            <div class="row justify-content-center">
                <div class="col-md-4 feature">
                    <i class="bi bi-calendar-check"></i>
                    <h3>Clases</h3>
                    <p>Consulta el calendario de clases, horarios y entrenadores disponibles.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="bi bi-credit-card"></i>
                    <h3>Membresías</h3>
                    <p>Visualiza el estado de tu membresía, pagos pendientes y renovaciones.</p>
                </div>
                <div class="col-md-4 feature">
                    <i class="bi bi-graph-up"></i>
                    <h3>Progreso</h3>
                    <p>Monitorea tu asistencia, evolución y logros como nadador.</p>
                </div>
            </div>
        </section>

        <section class="privacy-section text-white mx-auto">
            <h2>🔒 Aviso de Privacidad</h2>
            <p>
                En el Club de Natación valoramos la privacidad de tus datos personales y nos comprometemos a protegerlos. Toda la información que nos proporcionas se usa exclusivamente para la administración y operación del club, asegurando su confidencialidad y seguridad.
            </p>
            <p>
                Tus datos no serán compartidos con terceros sin tu consentimiento explícito. Puedes ejercer tus derechos ARCO (Acceso, Rectificación, Cancelación y Oposición) en cualquier momento, contactando a nuestro equipo administrativo.
            </p>
            <p>
                Además, cumplimos estrictamente con la normativa vigente de protección de datos personales para garantizar tu tranquilidad.
            </p>
            <p class="text-muted"><small>Última actualización: agosto 2025</small></p>
        </section>

        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 contact-info">
                        <h5>Contacto</h5>
                        <p><i class="bi bi-envelope"></i> correo@clubnatacion.com.mx</p>
                        <p><i class="bi bi-telephone"></i> +52 55 1234 5678</p>
                        <p><i class="bi bi-geo-alt"></i> Av. De la Natación 123, Ciudad de México</p>
                        <p><i class="bi bi-clock"></i> Lun - Vie: 7am - 9pm | Sáb: 8am - 2pm</p>
                    </div>
                    <div class="col-md-4 footer-links">
                        <h5>Enlaces Útiles</h5>
                        <a href="#" class="d-block">Inicio</a>
                        <a href="#" class="d-block">Clases</a>
                        <a href="#" class="d-block">Membresías</a>
                        <a href="#" class="d-block">Contacto</a>
                        <a href="#" class="d-block">Aviso de Privacidad</a>
                    </div>
                    <div class="col-md-4 social-icons">
                        <h5>Síguenos</h5>
                        <a href="#" aria-label="Facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Twitter" title="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" aria-label="Instagram" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="footer-legal mt-4">
                    <small>
                        &copy; {{ date('Y') }} Club de Natación. Todos los derechos reservados. <br />
                        Este sitio cumple con la <a href="#">Política de Privacidad</a> y <a href="#">Términos de Uso</a>.
                    </small>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function revealOnScroll() {
            const elements = document.querySelectorAll('.fadeInUp');
            const windowHeight = window.innerHeight;
            elements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                if (elementTop < windowHeight - 100) {
                    el.classList.add('visible');
                }
            });

            const features = document.querySelectorAll('.feature');
            features.forEach(f => {
                const top = f.getBoundingClientRect().top;
                if (top < windowHeight - 100) {
                    f.classList.add('visible');
                }
            });
        }

        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);
    </script>
</body>
</html>
