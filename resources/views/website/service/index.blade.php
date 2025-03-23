@extends('layouts.web')

@section('content')
<section>
    <x-header-page
        complement="Serviços de Astrologia, Tarot, Numerologia, Feng Shui e mais"
        :title="$seo['title']"
        :description="$seo['description']"
    />

    <section class="p-4 mb-4 rounded shadow-sm bg-light">
        <form id="filterForm" class="row g-3" method="GET" action="{{ route('website.service.index') }}">
            <!-- 🔍 Nome do Serviço -->
            <div class="col-md-6">
                <label for="searchTitle" class="form-label fw-semibold">🔍 Nome do Serviço</label>
                <input type="text" class="form-control" id="searchTitle" name="searchTitle"
                       placeholder="Digite o nome do serviço" value="{{ request('searchTitle') }}">
            </div>

            <!-- 🌎 Estado -->
            <div class="col-md-3">
                <label for="state" class="form-label fw-semibold">🌎 Estado</label>
                <input list="stateList" id="state" name="state" class="form-control"
                       placeholder="Digite ou selecione um estado" value="{{ request('state') }}">
                <datalist id="stateList"></datalist>
            </div>

            <!-- 🏙️ Cidade -->
            <div class="col-md-3">
                <label for="city" class="form-label fw-semibold">🏙️ Cidade</label>
                <input list="cityList" id="city" name="city" class="form-control"
                       placeholder="Digite a cidade" value="{{ request('city') }}">
                <datalist id="cityList"></datalist>
                <span class="form-text text-muted">Selecione um estado primeiro</span>
            </div>

            <!-- 💰 Faixa de Preço -->
            <div class="col-md-3">
                <label for="priceFilter" class="form-label fw-semibold">💰 Faixa de Preço</label>
                <select id="priceFilter" class="form-select" name="priceFilter">
                    <option value="">Todos</option>
                    <option value="low" {{ request('priceFilter') == 'low' ? 'selected' : '' }}>Menos de R$50</option>
                    <option value="medium" {{ request('priceFilter') == 'medium' ? 'selected' : '' }}>R$50 - R$200</option>
                    <option value="high" {{ request('priceFilter') == 'high' ? 'selected' : '' }}>Mais de R$200</option>
                </select>
            </div>

            <!-- 📍 Modalidade -->
            <div class="col-md-3">
                <label for="presencial" class="form-label fw-semibold">📍 Modalidade</label>
                <select id="presencial" class="form-select" name="presencial">
                    <option value="">Todos</option>
                    <option value="0" {{ request('presencial') == '1' ? 'selected' : '' }}>Presencial</option>
                    <option value="1" {{ request('online') == '0' ? 'selected' : '' }}>Online</option>
                </select>
            </div>

            <!-- 📞 Tipo de Contato -->
            <div class="col-md-3">
                <label for="contactType" class="form-label fw-semibold">📞 Tipo de Contato</label>
                <select id="contactType" class="form-select" name="contactType">
                    <option value="">Todos</option>
                    <option value="whatsapp" {{ request('contactType') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                    <option value="email" {{ request('contactType') == 'email' ? 'selected' : '' }}>E-mail</option>
                    <option value="telefone" {{ request('contactType') == 'telefone' ? 'selected' : '' }}>Telefone</option>
                </select>
            </div>

            <!-- 🔎 Botão de Busca -->
            <div class="mt-3 text-center col-12">
                <button type="submit" class="px-4 btn btn-primary">🔎 Buscar Serviços</button>
            </div>
        </form>
    </section>

    <!-- Exibição dos Resultados -->
    <div id="serviceList" class="row">
        @forelse ($services as $service)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <x-card-service :service="$service" />
            </div>
        @empty
            <div class="text-center col-12">
                <p class="text-muted fw-bold fs-5">⚠️ Nenhum serviço encontrado para os filtros selecionados.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $services->links() }}
    </div>
</section>
@stop

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let estados = {};

        // 🚀 Buscar estados via API do IBGE
        fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            .then(response => response.json())
            .then(data => {
                let stateList = document.getElementById('stateList');

                data.forEach(state => {
                    estados[state.nome] = state.sigla;
                    let option = document.createElement('option');
                    option.value = state.nome;
                    stateList.appendChild(option);
                });
            });

        // 🚀 Buscar cidades ao selecionar um estado
        document.getElementById('state').addEventListener('input', function () {
            let stateName = this.value;
            let stateUF = estados[stateName];

            if (!stateUF) return;

            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${stateUF}/municipios`)
                .then(response => response.json())
                .then(data => {
                    let cityList = document.getElementById('cityList');
                    cityList.innerHTML = '';
                    data.forEach(city => {
                        let option = document.createElement('option');
                        option.value = city.nome;
                        cityList.appendChild(option);
                    });
                });
        });
    });
</script>
@stop
