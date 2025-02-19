@extends('layouts.web')

@section('title', 'Sabedoria Ancestral')

@section('subtitle')
Conecte-se com a natureza e com o universo
@stop

@section('content')
<section class="container my-5">
    <div class="mb-3 rounded shadow-sm card">
        <div class="card-body">
            <div class="row">
                <!-- Imagem da Erva -->
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="{{ $herb->image }}"
                         class="rounded shadow card-img-top"
                         style="max-width: 100%; height: auto; object-fit: cover; border-radius: 10px;"
                         alt="Alecrim">
                </div>

                <!-- Informações da Erva -->
                <div class="col-md-8">
                    <h2 class="mb-3 text-center card-title">🌿 {{ $herb->name }}</h2>
                    <div class="mb-3 text-center">
                        <span class="badge" style="{{ $herb->full_color_planet }}">
                            {{ $herb->full_planet_name }}
                        </span>
                        <span class="badge {{ $herb->full_color_element }}">
                            {{ $herb->full_element_name }}
                        </span>
                    </div>

                    <p class="text-justify text-muted">
                        {{ $herb->description }}
                    </p>
                    <div class="gap-2 d-flex justify-content-between align-items-center">
                        <button class="gap-1 btn btn-outline-danger btn-sm d-flex align-items-center">
                            ❤️ <span>Favoritar</span>
                            <span class="fw-semibold">(0)</span>
                        </button>

                        <button class="gap-1 btn btn-outline-info btn-sm d-flex align-items-center">
                            🔗 <span>Compartilhar</span>
                        </button>
                    </div>

                </div>
            </div>

            <hr>

            <!-- Seções de Informações Detalhadas -->
            <div class="row">
                <div class="col-md-6">
                    <h5>📜 História e Origem</h5>
                    <p>
                        {{ $herb->history_origin }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>🔮 Usos Mágicos</h5>
                    <p>
                        {{ $herb->magical_uses }}
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5>🌱 Usos Biológicos</h5>
                    <p>
                        {{ $herb->biological_uses }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>⚠️ Precauções</h5>
                    <p>
                        {{ $herb->precautions }}
                    </p>
                </div>
            </div>
            <div class=" credits text-muted">
                <p>
                    Publicado por:
                    <a href="#" class="fw-bold text-decoration-none">{{ $herb->user->name }}</a>
                    | Publicado em: <span class="fw-semibold">{{ $herb->created_at->format('d/m/Y') }}</span>
                    | Revisado por <span class="fw-semibold">2 pessoas</span>.
                </p>
            </div>

            <hr>

            <!-- Receitas Mágicas -->
            <h3 class="mb-3 text-center ">✨ Receitas Mágicas com Alecrim</h3>
            <div class="row">
                @forelse ( $herb->alchemies as $alchemie)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="shadow-sm card h-100">
                        <img src="https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg"
                             class="card-img-top"
                             alt="Alecrim"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="text-center card-title">
                                {{ $alchemie->name }}
                            </h5>
                            <div class="text-center">
                                <span class="badge" style="{{ $alchemie->full_color_type }}">
                                    {{ $alchemie->full_type_name }}
                                </span>
                            </div>
                            <hr>
                            <p class="text-justify card-text">
                                {{ $alchemie->description }}
                            </p>
                            <div class="mt-auto text-center">
                                <a href="#" class="btn btn-success w-100">
                                    Ver mais
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <p>Não foram encontrados resultados para a busca.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Comentários -->
    <div class="mb-3 rounded shadow-sm card">
        <div class="card-body">
            <h3 class="mb-3 text-center">📝 Comentários</h3>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <img src="https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg"
                             class="rounded-circle"
                             style="width: 50px; height: 50px; object-fit: cover;"
                             alt="Usuário 1">
                        <div class="ms-3">
                            <h6 class="mb-0">Usuário 1</h6>
                            <small class="text-muted">🌟🌟🌟🌟🌟</small>
                        </div>
                    </div>
                    <small class="text-muted"></small>Há 2 dias</small>
                </div>
                <p class="mt-2 text-muted">Alecrim é uma erva incrível, uso sempre em meus rituais de proteção e limpeza espiritual.</p>
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
