<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    
    <!-- Font Mística -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&family=Courgette&display=swap" rel="stylesheet">
    
    <!-- Estilos Personalizados -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
    
    <title>{{ $seo['title_for_tag'] ?? 'Sabedoria Ancestral' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Conecte-se com a natureza e com o universo' }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? 'sabedoria, ancestral, natureza, universo' }}">
    
    <!-- Open Graph (Facebook, LinkedIn, etc.) -->
    <meta property="og:title" content="{{ $seo['og']['title'] ?? 'Sabedoria Ancestral' }}">
    <meta property="og:description" content="{{ $seo['og']['description'] ?? 'Conecte-se com a natureza e com o universo' }}">
    <meta property="og:image" content="{{ $seo['og']['image'] ?? asset('images/default-image.jpg') }}">
    <meta property="og:url" content="{{ $seo['og']['url'] ?? url('/') }}">
    <meta property="og:type" content="website">
</head>

<body class="bg-green-1">
    <nav class="shadow-sm navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand site-title" href="{{ route('website.index') }}">Sabedoria Ancestral</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="mx-auto navbar-nav">
                    @foreach([
                        ['route' => 'website.index', 'icon' => '🏠', 'label' => 'Home'],
                        ['route' => 'website.sobre', 'icon' => '📜', 'label' => 'Sobre'],
                        ['route' => 'website.ervas', 'icon' => '🌿', 'label' => 'Ervas'],
                        ['route' => 'website.alquimias', 'icon' => '🔮', 'label' => 'Alquimias'],
                        ['route' => 'website.calendario-lunar', 'icon' => '🌙', 'label' => 'Calendário Lunar'],
                        ['route' => 'website.planetas', 'icon' => '🪐', 'label' => 'Planetas'],
                        ['route' => 'website.hora-planetaria', 'icon' => '⏳', 'label' => 'Hora Planetária']
                    ] as $menuItem)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs($menuItem['route']) ? 'active' : '' }}" href="{{ route($menuItem['route']) }}">
                                {{ $menuItem['icon'] }} {{ $menuItem['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Entrar</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Cadastrar</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="py-4 text-center text-white bg-dark">
        <div class="container">
            <p>&copy; 2025 Sabedoria Ancestral. Todos os direitos reservados.</p>
            <p><strong>📍 Endereço:</strong> Rua Dicavalcanti, 220 - Rosa dos Ventos</p>
            <p><strong>📧 Contato:</strong> contato@ixani.com.br</p>
            <p>
                <a href="privacy-policy.php" class="text-white text-decoration-none">Política de Privacidade</a> |
                <a href="terms.php" class="text-white text-decoration-none">Termos de Uso</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
