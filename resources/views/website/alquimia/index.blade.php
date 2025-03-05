@extends('layouts.web')

@section('content')
<section>
    <x-header-page
        :title="$seo['title']"
        :description="$seo['description']"
    />

    <!-- Seção de Filtros -->
    <div class="p-4 mb-4 rounded shadow-sm bg-light">
        <form id="filterForm" class="row g-3">
            <div class="col-md-4">
                <label for="searchAlchemy" class="form-label fw-semibold">🔍 Nome da Alquimia</label>
                <input type="text" class="form-control" id="searchAlchemy" placeholder="Digite o nome da alquimia">
            </div>

            <div class="col-md-4">
                <label for="alchemyTypeSelect" class="form-label fw-semibold">🧪 Tipo de Alquimia</label>
                <select id="alchemyTypeSelect" class="form-select">
                    <option value="">Todos</option>
                    <option value="banho">Banho</option>
                    <option value="poção">Poção</option>
                    <option value="incenso">Incenso</option>
                    <option value="talismã">Talismã</option>
                    <option value="ritual">Ritual</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="moonPhaseSelect" class="form-label fw-semibold">🌙 Fase da Lua</label>
                <select id="moonPhaseSelect" class="form-select">
                    <option value="">Todas</option>
                    <option value="nova">Lua Nova</option>
                    <option value="crescente">Lua Crescente</option>
                    <option value="cheia">Lua Cheia</option>
                    <option value="minguante">Lua Minguante</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="dayOfWeekSelect" class="form-label fw-semibold">📅 Melhor Dia</label>
                <select id="dayOfWeekSelect" class="form-select">
                    <option value="">Todos</option>
                    <option value="segunda">Segunda-feira</option>
                    <option value="terça">Terça-feira</option>
                    <option value="quarta">Quarta-feira</option>
                    <option value="quinta">Quinta-feira</option>
                    <option value="sexta">Sexta-feira</option>
                    <option value="sábado">Sábado</option>
                    <option value="domingo">Domingo</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="elementSelect" class="form-label fw-semibold">🌿 Elemento</label>
                <select id="elementSelect" class="form-select">
                    <option value="">Todos</option>
                    <option value="fogo">Fogo</option>
                    <option value="terra">Terra</option>
                    <option value="ar">Ar</option>
                    <option value="água">Água</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="planetSelect" class="form-label fw-semibold">🪐 Planeta Regente</label>
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

            <div class="mt-3 text-center col-12">
                <button type="submit" class="px-4 btn btn-primary">
                    🔎 Buscar Alquimias
                </button>
            </div>
        </form>
    </div>

    <!-- Listagem de Alquimias -->
    <div class="row" id="alchemieList">
        @forelse ($alchemies as $alchemy)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="mb-4 border-0 shadow-sm card h-100">
                    <img src="{{ $alchemy->image }}" class="card-img-top rounded-top"
                        alt="{{ $alchemy->name }}" title="{{ $alchemy->name }}"
                        style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="text-center card-title fw-bold text-dark">
                            {{ $alchemy->name }}
                        </h5>
                        
                        <!-- Badge da Categoria -->
                        <h6 class="flex-wrap gap-2 mb-2 text-center card-subtitle text-body-secondary d-flex justify-content-center">
                            <x-badge :content="$alchemy->alchemyType->name"
                                :colorBackground="$alchemy->alchemyType->color_background"
                                :colorText="$alchemy->alchemyType->color_text"
                                :icon="$alchemy->alchemyType->symbol" />
                        </h6>

                        <hr>

                        <p class="text-muted text-start">
                            {{ Str::limit($alchemy->description, 120) }}
                        </p>

                        <hr>

                        <div class="mt-auto text-center">
                            <a href="{{ route('website.alquimia', ['slug' => $alchemy->slug]) }}" class="btn btn-success w-100">
                                ✨ Ver Detalhes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center col-12">
                <p class="text-muted fw-bold fs-5">⚠️ Nenhuma alquimia encontrada para os filtros selecionados.</p>
            </div>
        @endforelse
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
