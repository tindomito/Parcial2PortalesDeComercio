<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }} :: UFC</title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            min-height: 100vh;
        }
        
        .navbar-custom {
            background: rgba(20, 20, 20, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem !important;
        }
        
        .nav-link:hover {
            color: #ffffff !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #ff0000, #cc0000);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }
        
        .nav-link.active {
            color: #ffffff !important;
        }
        
        main.container {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            margin-top: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            color: #ffffff;
        }
        
        main.container h1,
        main.container h2,
        main.container h3,
        main.container h4,
        main.container h5,
        main.container h6 {
            color: #ffffff;
        }
        
        main.container p,
        main.container label,
        main.container span,
        main.container div {
            color: rgba(255, 255, 255, 0.9);
        }
        
        .footer {
            background: rgba(20, 20, 20, 0.95) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 0;
            margin-top: auto;
        }
        
        .btn-logout {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.8);
            border-radius: 6px;
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background: rgba(255, 0, 0, 0.1);
            border-color: rgba(255, 0, 0, 0.5);
            color: #ffffff;
        }
        
        /* Pagination Styles */
        .pagination {
            gap: 0.5rem;
        }
        
        .pagination .page-link {
            background: rgba(30, 30, 30, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .pagination .page-link:hover {
            background: rgba(255, 0, 0, 0.2);
            border-color: rgba(255, 0, 0, 0.5);
            color: #ffffff;
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            border-color: transparent;
            color: #ffffff;
            font-weight: 600;
        }
        
        .pagination .page-item.disabled .page-link {
            background: rgba(20, 20, 20, 0.5);
            border-color: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="{{ route('home') }}">UFC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar menú de navegación">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <x-nav-link route="home">
                                Home
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="about">
                                Quiénes Somos
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="news.index">
                                Novedades
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="events.index">
                                Cartelera
                            </x-nav-link>
                        </li>
                        @auth
                            @if(auth()->user()?->role === \App\Models\User::ROLE_ADMIN)
                                <li class="nav-item">
                                    <x-nav-link route="admin.users">
                                        Panel de Admin
                                    </x-nav-link>
                                </li>
                            @endif
                            <li class="nav-item">
                                <form action="{{ url('/cerrar-sesion') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-logout">
                                        {{ auth()->user()->email }} (Cerrar Sesión)
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <x-nav-link route="auth.login">
                                    Iniciar Sesión
                                </x-nav-link>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        
        <main class="container p-4 flex-grow-1">
            @if (session()->has('feedback.message'))
                <div class="alert alert-{{ session()->get('feedback.type', 'success') }}">
                    {!! session()->get('feedback.message') !!}
                </div>
            @endif

            {{ $slot }}

        </main>
        
        <footer class="footer text-center">
            <p class="mb-0 text-white-50">Copyright &copy; Da Vinci 2024</p>
        </footer>
    </div>

    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
