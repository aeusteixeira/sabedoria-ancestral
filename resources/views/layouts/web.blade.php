<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font mística -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&family=Courgette&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('website.index') }}">
                Sabedoria Ancestral
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="mx-auto mb-2 navbar-nav me-auto mb-lg-0">
                    <!-- Seção: Ferramentas Esotéricas -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('website.index') ? 'active' : '' }}"
                            href="{{ route('website.index') }}">
                            🏠 Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('website.calendario-lunar') ? 'active' : '' }}" href="{{ route('website.calendario-lunar') }}">
                            🌙 Calendário Lunar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('website.planetas') ? 'active' : '' }}"
                            href="{{ route('website.planetas') }}">
                            🪐 Planetas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('website.hora-planetaria') ? 'active' : '' }}"
                            href="{{ route('website.hora-planetaria') }}">
                            ⏳ Hora Planetária
                        </a>
                    </li>
                    <!-- Dropdown: Ferramentas geral -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            🔮 Ferramentas Esotéricas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">🎴 Baralho Cigano</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">🔮 Tarot</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">🔢 Número do Destino
                                </a>

                    </li>
                </ul>
                <!-- Resumo da lua do dia, hora planetária e link para o perfil do usuário -->
                <div class="d-flex">
                    <p class="my-auto text-light me-3">🌕 Lua Cheia</p>
                    <p class="my-auto text-light me-3">⏳ Hora de Júpiter</p>
                    <a href="#" class="btn btn-outline-light">Perfil</a>
                </div>
            </div>
        </div>
    </nav>
    <header class="py-5 text-center text-light">
        <h1 id="title-header">
            @yield('title')
        </h1>
        <p id="subtitle-header">
            @yield('subtitle')
        </p>
        @yield('content_header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="py-3 text-center text-white bg-dark">
        <p>&copy; 2025 Portal Místico | Todos os direitos reservados</p>
        <p><a href="privacy-policy.php" class="text-white">Política de Privacidade</a> | <a href="terms.php"
                class="text-white">Termos de Uso</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="js/app.js"></script>

    @yield('js')

</body>

</html>
