@extends('layouts.web')

@section('content')
<section >

    <x-header-page
        :title="$seo['title']"
        :description="$seo['description']"
    />

    <section class="p-4 mb-4 rounded shadow-sm bg-light">
        <form id="filterForm" class="row g-3" method="GET" action="{{ route('website.herb.index') }}">
            <div class="col-md-12">
                <label for="searchName" class="form-label fw-semibold">🔍 Nome da Erva</label>
                <input type="text" class="form-control" id="searchName" name="searchName"
                       placeholder="Digite o nome da erva" value="{{ request('searchName') }}">
            </div>

            <div class="col-md-4">
                <label for="typeSelect" class="form-label fw-semibold">🌡️ Temperatura</label>
                <select id="typeSelect" class="form-select" name="typeSelect">
                    <option value="">Todos</option>
                    @foreach ($temperatures as $temperature)
                        <option value="{{ $temperature->id }}" {{ request('typeSelect') == $temperature->id ? 'selected' : '' }}>
                            {{ $temperature->symbol }} {{ $temperature->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="elementSelect" class="form-label fw-semibold">🌿 Elemento</label>
                <select id="elementSelect" class="form-select" name="elementSelect">
                    <option value="">Todos</option>
                    @foreach ($elements as $element)
                        <option value="{{ $element->id }}" {{ request('elementSelect') == $element->id ? 'selected' : '' }}>
                            {{ $element->symbol }} {{ $element->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="planetSelect" class="form-label fw-semibold">🪐 Planeta Regente</label>
                <select id="planetSelect" class="form-select" name="planetSelect">
                    <option value="">Todos</option>
                    @foreach ($planets as $planet)
                        <option value="{{ $planet->id }}" {{ request('planetSelect') == $planet->id ? 'selected' : '' }}>
                            {{ $planet->symbol }} {{ $planet->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3 text-center col-12">
                <button type="submit" class="px-4 btn btn-primary">🔎 Buscar Ervas</button>
            </div>
        </form>
    </section>

    <!-- Exibição dos Resultados -->
    <div id="herbList" class="row">
        @forelse ($herbs as $herb)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="mb-4 border-0 shadow-sm card h-100">
                    <img src="{{ $herb->image_url }}" class="card-img-top rounded-top"
                         alt="{{ $herb->name }}" title="{{ $herb->name }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="text-center card-title fw-bold text-dark">
                            {{ $herb->name }}
                        </h5>

                        <!-- Badges -->
                        <h6 class="flex-wrap gap-2 mb-2 text-center d-flex justify-content-center">
                            <x-badge :content="$herb->temperature->name" :colorBackground="$herb->temperature->color_background" :colorText="$herb->temperature->color_text" :icon="$herb->temperature->symbol" />
                                <x-badge :content="$herb->planet->name" :colorBackground="$herb->planet->color_background" :colorText="$herb->planet->color_text" :icon="$herb->planet->symbol" />
                                <x-badge :content="$herb->element->name" :colorBackground="$herb->element->color_background" :colorText="$herb->element->color_text" :icon="$herb->element->symbol" />
                        </h6>

                        <p class="text-muted text-start">
                            {{ Str::limit($herb->description, 120) }}
                        </p>

                        <div class="mt-auto text-center">
                            <a href="{{ route('website.herb.show', ['slug' => $herb->slug]) }}" class="btn btn-success w-100">
                                🌿 Ver Detalhes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center col-12">
                <p class="text-muted fw-bold fs-5">⚠️ Nenhuma erva encontrada para os filtros selecionados.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $herbs->links() }}
    </div>

</section>
@stop
