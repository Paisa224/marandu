<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Marandu') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            position: fixed;
            width: 100%;
            z-index: 1030;
        }
        .sidebar {
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            position: fixed;
            height: 100%;
            padding-top: 60px;
            width: 250px;
            z-index: 1020;
        }
        .sidebar-right {
            background-color: #ffffff;
            border-left: 1px solid #dee2e6;
            position: fixed;
            height: 100%;
            padding-top: 60px;
            right: 0;
            width: 250px;
            z-index: 1020;
        }
        .main-content {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            color: #343a40;
            margin-left: 250px;
            margin-right: 250px;
            padding-top: 70px;
        }
        .nav-link {
            color: #343a40 !important;
        }
        .nav-link.active {
            color: #007bff !important;
        }
        .nav-link:hover {
            background-color: #007bff;
            color: #ffffff !important;
            border-radius: 5px;
        }
        .card-header {
            background-color: #007bff;
            border-bottom: 1px solid #dee2e6;
            color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-link {
            color: #007bff;
        }
        .btn-link:hover {
            color: #0056b3;
        }
        @media (max-width: 768px) {
            .sidebar,
            .sidebar-right {
                display: none;
            }
            .main-content {
                margin-left: 0;
                margin-right: 0;
                padding-top: 60px;
            }
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .invalid-feedback {
            display: block;
        }
        .container {
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }
        .card {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('images/LogoM.png') }}" alt="Marandu" class="d-inline-block align-text-top" style="height: 30px;">
                    {{ config('app.name', 'Marandu') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} ({{ Auth::user()->username }}) <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">Perfil</a>
                                    <a class="dropdown-item" href="{{ route('settings') }}">Configuración</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                                <i class="fas fa-bars"></i>
                            </button>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @if (!Request::is('login') && !Request::is('register'))
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                        <div class="position-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">
                                        <i class="fas fa-home"></i> Pagina Principal
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('explore') }}">
                                        <i class="fas fa-hashtag"></i> Explorar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('notifications') }}">
                                        <i class="fas fa-bell"></i> Notificaciones
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile') }}">
                                        <i class="fas fa-user"></i> Perfil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings') }}">
                                        <i class="fas fa-cog"></i> Configuración
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesion
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div id="offcanvasSidebar" class="offcanvas offcanvas-start" tabindex="-1" aria-labelledby="offcanvasSidebarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Marandu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">
                                        <i class="fas fa-home"></i> Pagina Principal
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('explore') }}">
                                        <i class="fas fa-hashtag"></i> Explorar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('notifications') }}">
                                        <i class="fas fa-bell"></i> Notificaciones
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile') }}">
                                        <i class="fas fa-user"></i> Perfil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('settings') }}">
                                        <i class="fas fa-cog"></i> Configuración
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesion
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

                <main class="{{ Request::is('login') || Request::is('register') ? 'col-md-12' : 'main-content col-md-9 ms-sm-auto col-lg-10 px-md-4' }}">
                    @yield('content')
                </main>

                @if (!Request::is('login') && !Request::is('register') && !Request::is('tweets/*/edit'))
                    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar-right">
                        <div class="position-sticky pt-3">
                            @yield('sidebar-right')
                        </div>
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
