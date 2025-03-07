@extends('layouts.web')

@section('content')

<section class="container">
    <div class="row">
        <!-- Coluna da esquerda (perfil) -->
        <div class="col-md-4">
            <div class="shadow-sm card">
                <div class="text-center card-body">
                    <!-- Foto do perfil -->
                    <img src="{{ $user->profile_image }}" class="mb-3 rounded-circle" width="120" height="120"
                        alt="Foto de {{ $user->name }}">

                    <h3 class="fw-bold">{{ $user->name }}</h3>
                    <p class="text-muted">{{ $user->bio ?? 'Membro do Sabedoria Ancestral' }}</p>

                    <!-- Nível e Moedas -->
                    <p class="fw-semibold">🔮 Nível: {{ $user->level }}</p>
                    <p class="text-success">💰 Moedas: {{ $user->coins }}</p>

                    <!-- Redes Sociais -->
                    <p class="mt-3 fw-bold">🔗 Redes Sociais</p>
                    <div class="flex-wrap gap-2 d-flex justify-content-center">
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                        <a href="#" class="btn btn-sm btn-info">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="#" class="btn btn-sm btn-danger">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                        <a href="#" class="btn btn-sm btn-warning">
                            <i class="fab fa-youtube"></i> YouTube
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-3 shadow-sm card">
                <div class="card-body">
                    <h4 class="fw-bold">🏅 Emblemas Conquistados</h4>
                    <div class="flex-wrap gap-3 d-flex justify-content-center">
                        @foreach($badges as $badge)
                        @php
                            $conquistado = $user->badges->contains($badge->id);
                            $badgeStyle = $conquistado ? "background-color: {$badge->color_background}; color:
                            {$badge->color_text};" : "background-color: #ccc; color: #666;";
                        @endphp
                        <span class="badge" style="padding: 10px; font-size: 14px; {{ $badgeStyle }}"
                            data-bs-toggle="tooltip" title="{{ $badge->description }}">
                            {!! $badge->symbol !!} {{ $badge->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Coluna da direita (Atividades do usuário) -->
        <div class="col-md-8">
            <div class="shadow-sm card">
                <div class="card-body">
                    <!-- Navegação das Abas -->
                    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="services-tab" data-bs-toggle="tab" data-bs-target="#services"
                                type="button" role="tab" aria-controls="services" aria-selected="true">
                                🛠️ Meus serviços
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="alquimias-tab" data-bs-toggle="tab" data-bs-target="#alquimias"
                                type="button" role="tab" aria-controls="alquimias" aria-selected="false">
                                🔮 Alquimias publicadas
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ervas-tab" data-bs-toggle="tab" data-bs-target="#ervas"
                                type="button" role="tab" aria-controls="ervas" aria-selected="false">
                                🌿 Ervas publicadas
                            </button>
                        </li>
                    </ul>

                    <!-- Conteúdo das Abas -->
                    <div class="mt-3 tab-content" id="profileTabsContent">

                        <!-- Aba services -->
                        <div class="tab-pane fade show active" id="services" role="tabpanel" aria-labelledby="services-tab">
                            <div class="mb-3 header d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold">🛠️ Serviços Criados</h4>
                                @if (Auth::user()->id == $user->id)
                                    <a href="{{ route('website.service.create') }}" class="btn btn-sm btn-success">Publicar Serviço</a>
                                @endif
                            </div>
                            <div class="row">
                                @forelse($user->services as $service)
                                <div class="mb-3 col-md-6">
                                    <x-card-service :service="$service" />
                                </div>
                                @empty
                                    <p class="text-muted">Este usuário ainda não cadastrou nenhum serviço.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Aba Alquimias Criadas -->
                        <div class="tab-pane fade" id="alquimias" role="tabpanel" aria-labelledby="alquimias-tab">
                            <div class="mb-3 header d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold">
                                    🔮 Alquimias Criadas
                                </h4>
                                <a href="#" class="btn btn-sm btn-success">Publicar Alquimia</a>
                            </div>
                            <div class="row">
                                @forelse($user->alchemies as $alchemy)
                                <div class="col-md-6">
                                    <div class="mb-3 card">
                                        <img src="{{ $alchemy->image }}" class="card-img-top"
                                            alt="{{ $alchemy->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $alchemy->name }}</h5>
                                            <p class="text-muted">{{ Str::limit($alchemy->description, 80) }}</p>
                                            <a href="{{ route('website.alchemy.show', ['slug' => $alchemy->slug]) }}"
                                                class="btn btn-sm btn-primary">Ver mais</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <p class="text-muted">Este usuário ainda não criou nenhuma alquimia.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Aba Ervas Cadastradas -->
                        <div class="tab-pane fade" id="ervas" role="tabpanel" aria-labelledby="ervas-tab">
                            <div class="mb-3 header d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold">🌿 Ervas Cadastradas</h4>
                                <a href="#" class="btn btn-sm btn-success">Cadastrar Erva</a>
                            </div>
                            <div class="row">
                                @forelse($user->herbs as $herb)
                                <div class="col-md-6">
                                    <div class="mb-3 card">
                                        <img src="{{ $herb->image }}" class="card-img-top" alt="{{ $herb->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $herb->name }}</h5>
                                            <p class="text-muted">{{ Str::limit($herb->description, 80) }}</p>
                                            <a href="{{ route('website.herb.show', ['slug' => $herb->slug]) }}"
                                                class="btn btn-sm btn-primary">Ver mais</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p class="text-muted">Este usuário ainda não cadastrou nenhuma erva.</p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@stop

@section('js')
<script>
    // Ativar tooltips de bootstrap para os emblemas
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });

</script>
@stop
