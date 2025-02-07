@extends('layouts.web')

@section('title', 'Sabedoria Ancestral')

@section('subtitle')
Conecte-se com a natureza e com o universo
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
            <div class="col">
                <div class="shadow-sm card h-100">
                    <img src="https://cdn.awsli.com.br/2660/2660278/produto/246588082/alecrim-folhas-100g-34ddlilbap.jpg"
                         class="card-img-top"
                         alt="Alecrim"
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="text-center card-title">Alecrim</h5>
                        <h6 class="mb-2 text-center card-subtitle text-body-secondary">🔥 Quente | ☀️ Sol </h6>
                        <hr>
                        <p class="text-justify card-text">
                            O alecrim é uma erva quente associada ao sol e ao elemento fogo. Suas folhas possuem propriedades purificantes e energizantes, sendo utilizadas em rituais de proteção, limpeza e fortalecimento espiritual.
                        </p>

                        <ul class="list-group list-group-horizontal justify-content-center">
                            <li class="text-center list-group-item">
                                🍵 Chás <span class="text-white badge bg-info">4</span>
                            </li>
                            <li class="text-center list-group-item">
                                🌿 Banhos <span class="text-white badge bg-info">3</span>
                            </li>
                            <li class="text-center list-group-item">
                                🪄 Feitiços <span class="text-white badge bg-info">2</span>
                            </li>
                        </ul>

                        <hr>

                        <div class="mt-auto text-center">
                            <a href="{{ route('website.erva') }}" class="btn btn-success w-100">
                                Ver mais
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
