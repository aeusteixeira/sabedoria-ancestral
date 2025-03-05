@extends('layouts.web')

@section('title', 'Sabedoria Ancestral')

@section('subtitle')
Conecte-se com a natureza e com o universo
@stop

@section('content')
<section  >
    <div class="mb-4 border-0 rounded shadow-sm card">
        <div class="p-4 card-body">
            <div class="row">
                <!-- Imagem da Erva + Avaliação -->
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <img src="{{ $herb->image }}" class="rounded shadow-sm card-img-top"
                        style="max-width: 100%; height: auto; object-fit: cover; border-radius: 12px;"
                        alt="{{ $herb->name }}" title="{{ $herb->name }}">

                    <!-- Botões de Interação -->
                    <div class="flex-wrap gap-2 mt-4 d-flex justify-content-center">
                        <button class="gap-1 btn btn-outline-danger btn-sm d-flex align-items-center">
                            ❤️ <span>Favoritar</span> <span class="fw-semibold">(0)</span>
                        </button>

                        <button class="gap-1 btn btn-outline-info btn-sm d-flex align-items-center">
                            🔗 <span>Compartilhar</span>
                        </button>
                    </div>
                </div>

                <!-- Informações da Erva -->
                <div class="col-md-8">
                    <h2 class="mb-3 text-center text-success fw-bold">
                        🌿 {{ $herb->name }}
                    </h2>

                    <p class="mt-3 text-justify text-muted">
                        {{ $herb->description }}
                    </p>

                    <div class="mt-3 row">
                        <div class="mb-2 col-sm-12 col-md-6">
                            <h5 class="text-primary">
                                🌡️ Temperatura:
                            </h5>
                                <x-badge :content="$herb->temperature->name" :colorBackground="$herb->temperature->color_background" :colorText="$herb->temperature->color_text" :icon="$herb->temperature->symbol" />
                        </div>
                        <div class="mb-2 col-sm-12 col-md-6">
                            <h5 class="text-primary">
                                🪐 Planeta Regente:
                            </h5>
                                <x-badge :content="$herb->planet->name" :colorBackground="$herb->planet->color_background" :colorText="$herb->planet->color_text" :icon="$herb->planet->symbol" />
                        </div>
                        <div class="mb-2 col-sm-12 col-md-6">
                            <h5 class="text-primary">
                                🪨 Elemento Regente:
                            </h5>
                            <ul class="list-unstyled">
                                    <x-badge :content="$herb->element->name" :colorBackground="$herb->element->color_background" :colorText="$herb->element->color_text" :icon="$herb->element->symbol" />
                            </ul>
                        </div>
                        <div class="mb-2 col-sm-12 col-md-6">
                            <h5 class="text-primary">
                                🪬 Chakras Regentes:
                            </h5>
                            <div class="flex-wrap gap-2 d-flex">
                                @forelse ($herb->chakras as $chakra)
                                    <x-badge :content="$chakra->name" :colorBackground="$chakra->color_background" :colorText="$chakra->color_text" :icon="$chakra->symbol" />
                                @empty
                                    <p class="text-muted">Nenhum chakra encontrado</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

            <hr>

            <!-- Informações Detalhadas -->
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-primary">📜 História e Origem</h5>
                    <p class="text-secondary">{{ $herb->history_origin }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-primary">🔮 Usos Mágicos</h5>
                    <p class="text-secondary">{{ $herb->magical_uses }}</p>
                </div>
            </div>

            <div class="mt-3 row">
                <div class="col-md-6">
                    <h5 class="text-primary">🌱 Usos Biológicos</h5>
                    <p class="text-secondary">{{ $herb->biological_uses }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-danger">⚠️ Precauções</h5>
                    <p class="text-secondary">{{ $herb->precautions }}</p>
                </div>
            </div>

            <hr>

            <!-- Créditos -->
            <div class="mt-3 text-center text-muted small">
                <p class="mb-0">
                    Publicado por: <a href="#" class="fw-bold text-decoration-none">{{ $herb->user->name }}</a>
                    | Publicado em: <span class="fw-semibold">{{ $herb->created_at->format('d/m/Y') }}</span>
                    | Revisado por <span class="fw-semibold">2 pessoas</span>.
                </p>
            </div>

            <hr>

            <!-- Receitas Mágicas com a Erva -->
            <h3 class="mb-3 text-center">✨ Receitas Mágicas com {{ $herb->name }}</h3>
            <div class="row">
                @forelse ($herb->alchemies as $alchemie)
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                        <div class="border-0 shadow-sm card h-100">
                            <img src="{{ $alchemie->image ?? 'https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg' }}"
                                 class="card-img-top rounded-top"
                                 alt="{{ $alchemie->name }}"
                                 style="height: 200px; object-fit: cover;">

                            <div class="p-3 card-body d-flex flex-column">
                                <h5 class="text-center card-title">
                                    {{ $alchemie->name }}
                                </h5>
                                <div class="text-center">
                                    <span class="px-3 py-2 badge" style="{{ $alchemie->full_color_type }}">
                                        {{ $alchemie->full_type_name }}
                                    </span>
                                </div>
                                <hr>
                                <p class="text-justify text-muted card-text">
                                    {{ Str::limit($alchemie->description, 100) }}
                                </p>
                                <div class="mt-auto text-center">
                                    <a class="btn btn-success w-100" href="{{ route('website.alquimia', ['slug' => $alchemie->slug]) }}">
                                        Ver mais
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Nenhuma receita encontrada para esta erva.</p>
                @endforelse
            </div>
        </div>
    </div>



</section>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/ervas.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/ervas.js') }}"></script>
@stop
