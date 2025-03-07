<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        crossorigin="anonymous">

    <!-- Font Mística -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&family=Courgette&display=swap"
        rel="stylesheet">

    <!-- Estilos Personalizados -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('css')

    <title>{{ $seo['title_for_tag'] ?? 'Sabedoria Ancestral' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Conecte-se com a natureza e com o universo' }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? 'sabedoria, ancestral, natureza, universo' }}">

    <!-- Open Graph (Facebook, LinkedIn, etc.) -->
    <meta property="og:title" content="{{ $seo['og']['title'] ?? 'Sabedoria Ancestral' }}">
    <meta property="og:description"
        content="{{ $seo['og']['description'] ?? 'Conecte-se com a natureza e com o universo' }}">
    <meta property="og:image" content="{{ $seo['og']['image'] ?? asset('images/default-image.jpg') }}">
    <meta property="og:url" content="{{ $seo['og']['url'] ?? url('/') }}">
    <meta property="og:type" content="website">
    <style>
        .mobile-nav a {
            flex: 1;
            text-align: center;
            font-size: 14px;
            padding: 8px 0;
        }

        .mobile-nav i {
            display: block;
            font-size: 22px;
        }

    </style>
</head>

<body class="bg-green-1">
    <nav class="shadow-sm navbar navbar-expand-lg navbar-dark bg-dark d-none d-lg-flex">
        <div class="container">
            <a class="navbar-brand site-title" href="{{ route('website.index') }}">Sabedoria Ancestral</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="mx-auto navbar-nav">
                    @foreach([
                    ['route' => 'website.index', 'icon' => '🏠', 'label' => 'Home'],
                    ['route' => 'website.sobre', 'icon' => '📜', 'label' => 'Sobre'],
                    ['route' => 'website.herb.index', 'icon' => '🌿', 'label' => 'Ervas'],
                    ['route' => 'website.alchemy.index', 'icon' => '🔮', 'label' => 'Alquimias'],
                    ['route' => 'website.calendario-lunar', 'icon' => '🌙', 'label' => 'Calendário Lunar'],
                    ['route' => 'website.planetas', 'icon' => '🪐', 'label' => 'Planetas'],
                    ['route' => 'website.hora-planetaria', 'icon' => '⏳', 'label' => 'Hora Planetária']
                    ] as $menuItem)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($menuItem['route']) ? 'active' : '' }}"
                            href="{{ route($menuItem['route']) }}">
                            {{ $menuItem['icon'] }} {{ $menuItem['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                    <!-- Dropdown do Usuário Logado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->profile_image }}" class="rounded-circle me-2" width="30"
                                height="30" alt="Avatar">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('website.profile.index', auth()->user()->username) }}">
                                    <i class="fas fa-user-circle me-2"></i> Meu Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-2"></i> Configurações
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#publicarModal">
                                    <i class="fas fa-plus-circle me-2"></i> Publicar
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <!-- Seção de Autenticação (Usuário não logado) -->
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link btn btn-outline-light me-2">Entrar</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link btn btn-primary">Cadastrar</a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar Fixa no Rodapé para Celulares -->
    <div class="py-2 text-white shadow-lg mobile-nav d-flex d-lg-none bg-dark fixed-bottom">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('website.index') }}" class="text-center text-white text-decoration-none">
                <i class="fas fa-home fa-lg"></i><br>
                <small>Home</small>
            </a>
            <a href="{{ route('website.alchemy.index') }}" class="text-center text-white text-decoration-none">
                <i class="fas fa-flask fa-lg"></i><br>
                <small>Alquimias</small>
            </a>
            <a href="#" class="text-center text-white text-decoration-none" data-bs-toggle="modal"
                data-bs-target="#publicarModal">
                <i class="fas fa-plus-circle fa-lg"></i><br>
                <small>Publicar</small>
            </a>
            <a href="{{ route('website.herb.index') }}" class="text-center text-white text-decoration-none">
                <i class="fas fa-leaf fa-lg"></i><br>
                <small>Ervas</small>
            </a>
            @auth
            <a href="{{ route('website.profile.index', auth()->user()->username) }}"
                class="text-center text-white text-decoration-none">
                <i class="fas fa-user fa-lg"></i><br>
                <small>Perfil</small>
            </a>
            @else
            <a href="{{ route('login') }}" class="text-center text-white text-decoration-none">
                <i class="fas fa-sign-in-alt fa-lg"></i><br>
                <small>Entrar</small>
            </a>
            @endauth
        </div>
    </div>
    <!-- Modal de Publicação -->
    <div class="modal fade" id="publicarModal" tabindex="-1" aria-labelledby="publicarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="publicarModalLabel">📢 O que deseja publicar?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="text-center modal-body">
                    <p>Selecione o tipo de conteúdo que deseja compartilhar na plataforma.</p>

                    <!-- Opções em formato de Cards -->
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <a href="{{ route('website.alchemy.create') }}" class="text-decoration-none">
                                <div
                                    class="p-3 text-white rounded shadow-sm bg-dark d-flex flex-column align-items-center justify-content-center">
                                    <span class="fs-1">🔮</span>
                                    <h5 class="mt-2 fw-bold">Criar Alquimia</h5>
                                    <p class="mb-0 text-center small">Misture ervas, cristais e energias
                                        para criar rituais poderosos.</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-md-4">
                            <a href="{{ route('website.herb.create') }}" class="text-decoration-none">
                                <div
                                    class="p-3 text-white rounded shadow-sm bg-success d-flex flex-column align-items-center justify-content-center">
                                    <span class="fs-1">🌿</span>
                                    <h5 class="mt-2 fw-bold">Cadastrar Erva</h5>
                                    <p class="mb-0 text-center small">Adicione informações sobre ervas e
                                        seus usos mágicos.</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-md-4">
                            <a href="{{ route('website.service.create') }}" class="text-decoration-none">
                                <div
                                    class="p-3 text-white rounded shadow-sm bg-warning d-flex flex-column align-items-center justify-content-center">
                                    <span class="fs-1">💼</span>
                                    <h5 class="mt-2 fw-bold">Cadastrar Serviço</h5>
                                    <p class="mb-0 text-center small">Ofereça consultas esotéricas,
                                        leituras e outros serviços.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>
