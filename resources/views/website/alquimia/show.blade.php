@extends('layouts.web')

@section('content')
<section>
    <div class="mb-4 border-0 rounded shadow-sm card">
        <div class="p-4 card-body">
            <div class="row">
                <!-- Imagem da Receita + Avaliação -->
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <img src="{{ $alchemy->image }}" class="rounded shadow-sm card-img-top"
                        style="max-width: 100%; height: auto; object-fit: cover; border-radius: 12px;"
                        alt="{{ $alchemy->name }}" title="{{ $alchemy->name }}">

                    <!-- Avaliação e Comentários -->
                    <div class="mt-3 text-center w-100">
                        <h5 class="text-primary">⭐ Avaliações</h5>
                        <p class="text-secondary">Média: ★★★★☆ (4.5/5)</p>
                        <button class="btn btn-sm btn-warning">Deixar Avaliação</button>
                    </div>

                    <!-- Botões de Interação -->
                    <div class="flex-wrap gap-2 mt-4 d-flex justify-content-center">
                        <button class="gap-1 btn btn-outline-danger btn-sm d-flex align-items-center">
                            ❤️ <span>Favoritar</span> <span class="fw-semibold">(0)</span>
                        </button>

                        <button class="gap-1 btn btn-outline-info btn-sm d-flex align-items-center">
                            🔗 <span>Compartilhar</span>
                        </button>

                        <button class="gap-1 btn btn-outline-secondary btn-sm d-flex align-items-center">
                            🖨️ <span>Imprimir</span>
                        </button>
                    </div>
                </div>

                <!-- Informações da Receita -->
                <div class="col-md-8">
                    <h2 class="mb-3 text-center text-success fw-bold">
                        🌿 {{ $alchemy->name }}
                    </h2>

                    <!-- Objetivo Mágico -->
                    <div class="text-center">
                        <x-badge :content="$alchemy->alchemyType->name" :colorBackground="$alchemy->alchemyType->color_background" :colorText="$alchemy->alchemyType->color_text" :icon="$alchemy->alchemyType->symbol" />
                    </div>

                    <p class="mt-3 text-justify text-muted">
                        {{ $alchemy->description }}
                    </p>

                    <!-- Ingredientes Alquímicos -->
                    <div class="mt-3 row">
                        <div class="col-6">
                            <h5 class="text-primary">🌱 Ervas Utilizadas</h5>
                            <ul class="list-unstyled">
                                @forelse($alchemy->herbs as $herb)
                                    <li>✅ {{ $herb->name }}</li>
                                @empty
                                    <p class="text-muted">Nenhuma erva encontrada</p>
                                @endforelse
                            </ul>
                        </div>
                        <div class="col-6">
                            <h5 class="text-primary">💎 Cristais Utilizados</h5>
                            <ul class="list-unstyled">
                                @forelse($alchemy->stones as $crystal)
                                    <li>🔹 {{ $crystal->name }}</li>
                                @empty
                                    <p class="text-muted">Nenhum cristal encontrado</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Melhor Momento para Fazer -->
                    <div class="mt-3 row gy-2">
                        <div class="col-6">
                            <h5 class="text-primary">🌕 Melhor Lua</h5>
                            <p class="text-secondary">{{ $alchemy->moon->name }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="text-primary">📅 Melhor Dia</h5>
                            <p class="text-secondary">{{ $alchemy->dayOfWeek->name }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="text-primary">🕒 Melhor Hora Planetária</h5>
                            <p class="text-secondary">{{ $alchemy->hour->name }}</p>
                        </div>
                    </div>

                    <!-- Preparo -->
                    <div class="mt-3">
                        <h5 class="text-primary" id="preparo">🥄 Preparo</h5>
                        <p class="text-secondary">{{ $alchemy->preparation_method }}</p>
                    </div>

                    <!-- Precauções -->
                    <div class="mt-3">
                        <h5 class="text-danger">⚠️ Precauções</h5>
                        <p class="text-secondary">{{ $alchemy->precautions }}</p>
                    </div>

                    <!-- Aviso Importante -->
                    @if(stripos($alchemy->description, 'cura') !== false || stripos($alchemy->name, 'cura') !== false)
                        <div class="mt-3 alert alert-warning">
                            <strong>Aviso Importante:</strong> Esta receita contém promessas de cura. Consulte um
                            profissional de saúde antes de utilizar qualquer tratamento alternativo.
                        </div>
                    @endif
                </div>
            </div>

            <hr>

            <!-- Créditos -->
            <div class="mt-3 text-center text-muted small">
                <p class="mb-0">
                    Publicado por: <a href="#" class="fw-bold text-decoration-none">{{ $alchemy->user->name }}</a>
                    | Publicado em: <span class="fw-semibold">{{ $alchemy->created_at->format('d/m/Y') }}</span>
                    | Revisado por <span class="fw-semibold">2 pessoas</span>.
                </p>
            </div>
        </div>
    </div>




    <div class="rounded shadow-sm card">
        <div class="card-body">
            <h4 class="mb-4 text-center fw-bold">💬 Comentários</h4>

            <!-- Campo de comentário -->
            @auth
            <div class="mb-3">
                <textarea class="form-control" placeholder="Deixe seu comentário..." rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="px-4 btn btn-primary">
                    Comentar
                </button>
            </div>
            @else
            <div class="d-flex justify-content-center">
                <p>
                    <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">
                        Faca login para comentar
                    </a>
                </p>
            </div>
            @endauth

            <hr class="my-4">

            <!-- Comentário -->
            <div class="mb-3 shadow-sm card">
                <div class="card-body">
                    <div class="mb-2 d-flex align-items-center">
                        <img src="https://picsum.photos/50" class="rounded-circle me-3" alt="User Image">
                        <div>
                            <h6 class="mb-0">
                                <a href="#" class="text-decoration-none text-dark fw-semibold">
                                    Pablo Marinho
                                </a>
                            </h6>
                            <small class="text-muted">2h atrás</small>
                        </div>
                    </div>
                    <p class="mb-2">
                        Amei! Obrigado pelo compartilhamento!
                    </p>

                    <div class="mt-3 d-flex align-items-center">
                        <a href="#" class="text-danger text-decoration-none me-3">
                            <i class="fas fa-heart me-1"></i> 12
                        </a>
                    </div>
                    <div class="card" id="respostas">
                        <div class="card-body">
                            <div class="mb-2 d-flex align-items-center">
                                <img src="https://picsum.photos/50" class="rounded-circle me-3" alt="User Image">
                                <div>
                                    <h6 class="mb-0">
                                        <a href="#" class="text-decoration-none text-dark fw-semibold">Matheus Teixeira
                                            <span class="badge bg-primary">Autor</span></a>
                                    </h6>
                                    <small class="text-muted">2h atrás</small>
                                </div>
                            </div>
                            <p class="mb-2">
                                Bixa! Você por aqui!
                            </p>

                            <div class="mt-3 d-flex align-items-center"></div>
                            <a href="#" class="text-danger text-decoration-none me-3">
                                <i class="fas fa-heart me-1"></i> 12
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/ervas.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
@stop

@section('js')
<script src="{{ asset('js/ervas.js') }}"></script>
@stop
