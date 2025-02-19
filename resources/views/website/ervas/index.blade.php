@extends('layouts.web')

@section('title', 'Catálogo de Ervas Mágicas')

@section('subtitle')
    Saiba mais sobre as propriedades mágicas das ervas
@stop

@section('content')
    <section class="container my-5">
        <h1 class="mb-4" id="calendarTitle">
            Catálogo de Ervas Mágicas
        </h1>
        <p class="mb-4">
            As ervas possuem propriedades mágicas e energéticas que podem ser utilizadas em rituais, feitiços e práticas espirituais. Cada erva possui uma vibração única e pode ser associada a diferentes intenções e propósitos mágicos. Neste guia, você encontrará uma lista de ervas mágicas com suas correspondências, usos e propriedades. Explore o mundo das ervas e descubra como incorporá-las em sua prática espiritual.
        </p>

        <div class="filter-section">
            <form id="filterForm" class="row g-3">
                <div class="col-md-4">
                    <label for="searchName" class="form-label">Nome da Erva</label>
                    <input type="text" class="form-control" id="searchName" placeholder="Digite o nome da erva">
                </div>
                <div class="col-md-4">
                    <label for="typeSelect" class="form-label">Tipo de Erva</label>
                    <select id="typeSelect" class="form-select">
                        <option value="">Todos</option>
                        <option value="morna">Morna</option>
                        <option value="fria">Fria</option>
                        <option value="quente">Quente</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="planetSelect" class="form-label">Planeta Regente</label>
                    <select id="planetSelect" class="form-select">
                        <option value="">Todos</option>
                        <option value="sol">Sol</option>
                        <option value="lua">Lua</option>
                        <option value="marte">Marte</option>
                        <option value="mercúrio">Mercúrio</option>
                        <option value="júpiter">Júpiter</option>
                        <option value="vênus">Vênus</option>
                        <option value="saturno">Saturno</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Seção de Listagem de Ervas -->
        <div id="herbList" class="row row-cols-1 row-cols-md-3">
            <!-- Exemplo de Card de Erva -->
            @forelse ( $herbs as $herb)
            <div class="col">
                <div class="shadow-sm card h-100">
                    <img src="{{ $herb->image }}"
                         class="card-img-top"
                         alt="{{ $herb->name }}"
                         title="{{ $herb->name }}"
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="text-center card-title">
                            {{ $herb->name }}
                        </h5>
                        <h6 class="mb-2 text-center card-subtitle text-body-secondary">
                            <span class="badge" style="{{ $herb->full_color_planet }}">
                                {{ $herb->full_planet_name }}
                            </span>
                            <span class="badge {{ $herb->full_color_element }}">
                                {{ $herb->full_element_name }}
                            </span>
                        </h6>
                        <hr>
                        <p class="text-justify card-text">
                            {{ $herb->description }}
                        </p>

                        <ul class="list-group list-group-horizontal justify-content-center">
                            <li class="text-center list-group-item fw-bold d-flex align-items-center">
                                🌿 {{ $herb->alchemies->count() }}
                                {{ Str::plural('alquimia', $herb->alchemies->count()) }} associada{{ $herb->alchemies->count() > 1 ? 's' : '' }} a esta erva
                            </li>
                        </ul>


                        <hr>

                        <div class="mt-auto text-center">
                            <a href="{{ route('website.erva', ['slug' => $herb->slug]) }}" class="btn btn-success w-100">
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
    </section>
@stop

@section('css')
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .filter-section {
            margin-bottom: 20px;
        }
    </style>
@stop

@section('js')

@stop
