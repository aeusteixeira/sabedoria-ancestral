@extends('layouts.web')

@section('content')
<section class="container py-4">
    <div class="row g-4">
        <!-- Coluna da esquerda (perfil) -->
        <div class="col-md-4">
            <!-- Card Principal do Perfil -->
            <div class="border-0 shadow-sm card">
                <div class="text-center card-body">
                    <!-- Foto do perfil com efeito hover -->
                    <div class="position-relative d-inline-block">
                        <img src="{{ $user->profile_image }}" class="mb-3 rounded-circle" width="150" height="150"
                        alt="Foto de {{ $user->name }}">
                    </div>

                    <h3 class="mb-2 fw-bold">{{ $user->name }}</h3>
                    <p class="mb-3 text-muted">{{ $user->description ?? 'Membro do Sabedoria Ancestral' }}</p>

                    <!-- Nível e Progresso -->
                    <div class="mb-3">
                        <div class="mb-1 d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">🔮 Nível {{ $user->level }}</span>
                            <span class="text-muted">{{ $user->xp }}/{{ $user->next_level_xp }} XP</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: {{ ($user->xp / $user->next_level_xp) * 100 }}%"></div>
                        </div>
                    </div>

                    <!-- Moedas e Pontos -->
                    <div class="gap-3 mb-3 d-flex justify-content-center">
                        <div class="text-center">
                            <span class="text-success fw-bold">💰 {{ $user->coins }}</span>
                            <p class="mb-0 small text-muted">Moedas</p>
                        </div>
                        <div class="text-center">
                            <span class="text-primary fw-bold">⭐ {{ $user->points }}</span>
                            <p class="mb-0 small text-muted">Pontos</p>
                        </div>
                    </div>

                    <!-- Botões de Ação -->
                    @if (Auth::user()->id == $user->id)
                        <div class="gap-2 d-grid">
                            <a href="{{ route('website.profile.edit', $user->username) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i>Editar Perfil
                            </a>
                            <a href="{{ route('website.profile.settings', $user->username) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-cog me-2"></i>Configurações
                            </a>
                        </div>
                    @else
                        <div class="gap-2 d-grid">
                            {{--
                                <button class="btn btn-primary" onclick="sendMessage('{{ $user->username }}')">
                                    <i class="fas fa-envelope me-2"></i>Enviar Mensagem
                                </button>
                            --}}
                            <button class="btn {{ Auth::user()->isFollowing($user) ? 'btn-primary' : 'btn-outline-primary' }}"
                                    onclick="followUser('{{ $user->username }}')">
                                <i class="fas {{ Auth::user()->isFollowing($user) ? 'fa-user-minus' : 'fa-user-plus' }} me-2"></i>
                                {{ Auth::user()->isFollowing($user) ? 'Deixar de Seguir' : 'Seguir' }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Card de Estatísticas -->
            <div class="mt-4 border-0 shadow-sm card">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">📊 Estatísticas</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-2 text-center rounded bg-light">
                                <div class="mb-0 h4">{{ $user->services_count }}</div>
                                <small class="text-muted">Serviços</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 text-center rounded bg-light">
                                <div class="mb-0 h4">{{ $user->followers_count }}</div>
                                <small class="text-muted">Seguidores</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 text-center rounded bg-light">
                                <div class="mb-0 h4">{{ $user->following_count }}</div>
                                <small class="text-muted">Seguindo</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 text-center rounded bg-light">
                                <div class="mb-0 h4">{{ $user->alchemies_count }}</div>
                                <small class="text-muted">
                                    Alquimias
                                </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 text-center rounded bg-light">
                                <div class="mb-0 h4">{{ $user->herbs_count }}</div>
                                <small class="text-muted">Ervas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Emblemas -->
            <div class="mt-4 border-0 shadow-sm card">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">🏅 Emblemas</h5>
                    <div class="flex-wrap gap-2 d-flex justify-content-center">
                        @foreach($badges as $badge)
                        @php
                            $conquistado = $user->badges->contains($badge->id);
                                $badgeStyle = $conquistado ? "background-color: {$badge->color_background}; color: {$badge->color_text};" : "background-color: #eee; color: #999;";
                        @endphp
                            <div class="text-center" data-bs-toggle="tooltip" title="{{ $badge->description }}">
                                <div class="p-2 mb-1 rounded" style="{{ $badgeStyle }}">
                                    <span style="font-size: 24px;">{!! $badge->symbol !!}</span>
                                </div>
                                <small class="d-block">{{ $badge->name }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Coluna da direita (Atividades do usuário) -->
        <div class="col-md-8">
            <div class="border-0 shadow-sm card">
                <div class="card-body">
                    <!-- Navegação das Abas -->
                    <ul class="mb-4 nav nav-tabs nav-fill" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="services-tab" data-bs-toggle="tab" data-bs-target="#services"
                                type="button" role="tab" aria-controls="services" aria-selected="true">
                                <i class="fas fa-tools me-2"></i>Serviços
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="alquimias-tab" data-bs-toggle="tab" data-bs-target="#alquimias"
                                type="button" role="tab" aria-controls="alquimias" aria-selected="false">
                                <i class="fas fa-flask me-2"></i>Alquimias
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ervas-tab" data-bs-toggle="tab" data-bs-target="#ervas"
                                type="button" role="tab" aria-controls="ervas" aria-selected="false">
                                <i class="fas fa-leaf me-2"></i>Ervas
                            </button>
                        </li>
                    </ul>

                    <!-- Conteúdo das Abas -->
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Aba Serviços -->
                        <div class="tab-pane fade show active" id="services" role="tabpanel" aria-labelledby="services-tab">
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">🛠️ Serviços Criados</h5>
                                @if (Auth::user()->id == $user->id)
                                    <a href="{{ route('website.service.create') }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-plus me-2"></i>Novo Serviço
                                    </a>
                                @endif
                            </div>
                            <div class="row g-4">
                                @forelse($user->services as $service)
                                    <div class="col-md-6">
                                    <x-card-service :service="$service" />
                                </div>
                                @empty
                                    <div class="col-12">
                                        <div class="py-5 text-center">
                                            <i class="mb-3 fas fa-tools fa-3x text-muted"></i>
                                            <p class="mb-0 text-muted">Este usuário ainda não cadastrou nenhum serviço.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Aba Alquimias -->
                        <div class="tab-pane fade" id="alquimias" role="tabpanel" aria-labelledby="alquimias-tab">
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">🔮 Alquimias Criadas</h5>
                                @if (Auth::user()->id == $user->id)
                                <a href="{{ route('website.alchemy.create') }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-plus me-2"></i>Nova Alquimia
                                </a>
                                @endif
                            </div>
                            <div class="row g-4">
                                @forelse($user->alchemies as $alchemy)
                                <div class="col-md-6">
                                    <x-card :item="$alchemy" route="website.alchemy.show" type="alchemy" page="profile" />
                                </div>
                                @empty
                                    <div class="col-12">
                                        <div class="py-5 text-center">
                                            <i class="mb-3 fas fa-flask fa-3x text-muted"></i>
                                            <p class="mb-0 text-muted">Este usuário ainda não criou nenhuma alquimia.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Aba Ervas -->
                        <div class="tab-pane fade" id="ervas" role="tabpanel" aria-labelledby="ervas-tab">
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">🌿 Ervas Cadastradas</h5>
                                @if (Auth::user()->id == $user->id)
                                <a href="{{ route('website.herb.create') }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-plus me-2"></i>Nova Erva
                                </a>
                                @endif
                            </div>
                            <div class="row g-4">
                                @forelse($user->herbs as $herb)
                                <div class="col-md-6">
                                    <x-card :item="$herb" route="website.herb.show" type="herb" page="profile" />
                                </div>
                                @empty
                                    <div class="col-12">
                                        <div class="py-5 text-center">
                                            <i class="mb-3 fas fa-leaf fa-3x text-muted"></i>
                                            <p class="mb-0 text-muted">Este usuário ainda não cadastrou nenhuma erva.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    .nav-tabs .nav-link:hover {
        color: #0d6efd;
        background-color: #f8f9fa;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background-color: #e7f1ff;
        font-weight: 600;
    }
    .card {
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .progress {
        background-color: #e9ecef;
        border-radius: 1rem;
    }
    .progress-bar {
        border-radius: 1rem;
    }
</style>
@stop

@section('js')
<script>
    // Ativar tooltips
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });

    {{--
    // Função para enviar mensagem
    function sendMessage(username) {
        const content = prompt('Digite sua mensagem:');
        if (!content) return;

        fetch(`/profile/${username}/message`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ content })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao enviar mensagem. Tente novamente.');
        });
    }
    --}}
    // Função para seguir/deixar de seguir usuário
    function followUser(username) {
        const button = document.querySelector(`button[onclick="followUser('${username}')"]`);
        const isFollowing = button.classList.contains('btn-primary');
        const url = isFollowing ? `/profile/${username}/unfollow` : `/profile/${username}/follow`;
        const method = isFollowing ? 'DELETE' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Atualiza o botão
                button.classList.toggle('btn-primary');
                button.classList.toggle('btn-outline-primary');
                button.innerHTML = isFollowing ?
                    '<i class="fas fa-user-plus me-2"></i>Seguir' :
                    '<i class="fas fa-user-minus me-2"></i>Deixar de Seguir';

                // Atualiza o contador de seguidores
                const followersCount = document.querySelector('.followers-count');
                if (followersCount) {
                    followersCount.textContent = data.followers_count;
                }
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao processar a ação. Tente novamente.');
        });
    }
</script>
@stop
