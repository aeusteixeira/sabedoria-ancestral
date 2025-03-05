@extends('layouts.web')

@section('content')
<section>
    <x-header-page
        :title="$seo['title']"
        :description="$seo['description']"
    />

    <!-- Seção de Filtros -->
    <section class="p-4 mb-4 rounded shadow-sm bg-light">
        <form id="filterForm" class="row g-3" method="GET" action="{{ route('website.alchemy.index') }}">
            <div class="col-md-12">
                <label for="searchAlchemy" class="form-label fw-semibold">🔍 Nome da Alquimia</label>
                <input type="text" class="form-control" id="searchAlchemy" name="searchAlchemy"
                       placeholder="Digite o nome da alquimia" value="{{ request('searchAlchemy') }}">
            </div>

            <div class="col-md-4">
                <label for="alchemyTypeSelect" class="form-label fw-semibold">🧪 Tipo de Alquimia</label>
                <select id="alchemyTypeSelect" class="form-select" name="alchemyTypeSelect">
                    <option value="">Todos</option>
                    @foreach ($alquemyTypes as $alquemyType)
                        <option value="{{ $alquemyType->id }}"
                            {{ request('alchemyTypeSelect') == $alquemyType->id ? 'selected' : '' }}>
                            {{ $alquemyType->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="moonPhaseSelect" class="form-label fw-semibold">🌙 Fase da Lua</label>
                <select id="moonPhaseSelect" class="form-select" name="moonPhaseSelect">
                    <option value="">Todas</option>
                    @foreach ($moons as $moon)
                        <option value="{{ $moon->id }}"
                            {{ request('moonPhaseSelect') == $moon->id ? 'selected' : '' }}>
                            {{ $moon->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="dayOfWeekSelect" class="form-label fw-semibold">📅 Melhor Dia</label>
                <select id="dayOfWeekSelect" class="form-select" name="dayOfWeekSelect">
                    <option value="">Todos</option>
                    @foreach ($days as $day)
                        <option value="{{ $day->id }}"
                            {{ request('dayOfWeekSelect') == $day->id ? 'selected' : '' }}>
                            {{ $day->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3 text-center col-12">
                <button type="submit" class="px-4 btn btn-primary">
                    🔎 Buscar Alquimias
                </button>
            </div>
        </form>
    </section>


    <!-- Listagem de Alquimias -->
    <section class="row" id="alchemieList">
        @forelse ($alchemies as $alchemy)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="mb-4 border-0 shadow-sm card h-100">
                    <img src="{{ $alchemy->image_url }}" class="card-img-top rounded-top"
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
                            <a href="{{ route('website.alchemy.show', ['slug' => $alchemy->slug]) }}" class="btn btn-success w-100">
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
    </se>
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
