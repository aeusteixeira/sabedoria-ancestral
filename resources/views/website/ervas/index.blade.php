@extends('layouts.web')

@section('content')
<section  >

    <x-header-page
        :title="$seo['title']"
        :description="$seo['description']"
    />

    <!-- Seção de Filtros -->
    <div class="p-4 mb-4 rounded shadow-sm bg-light">
        <form id="filterForm" class="row g-3">
            <div class="col-md-4">
                <label for="searchName" class="form-label fw-semibold">🔍 Nome da Erva</label>
                <input type="text" class="form-control" id="searchName" placeholder="Digite o nome da erva">
            </div>
            <div class="col-md-4">
                <label for="typeSelect" class="form-label fw-semibold">🌡️ Tipo de Erva</label>
                <select id="typeSelect" class="form-select">
                    <option value="">Todos</option>
                    <option value="morna">Morna</option>
                    <option value="fria">Fria</option>
                    <option value="quente">Quente</option>
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
                <button type="submit" class="px-4 btn btn-primary">🔎 Buscar Ervas</button>
            </div>
        </form>
    </div>

    <!-- Listagem de Ervas -->
    <div class="row" id="herbList">
        @forelse ($herbs as $herb)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="mb-4 border-0 shadow-sm card h-100">
                    <img src="{{ $herb->image }}" class="card-img-top rounded-top" alt="{{ $herb->name }}" title="{{ $herb->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="text-center card-title fw-bold text-dark">{{ $herb->name }}</h5>
                        
                        <!-- Badges -->
                        <h6 class="flex-wrap gap-2 mb-2 text-center card-subtitle text-body-secondary d-flex justify-content-center">
                            <x-badge :content="$herb->temperature->name" :colorBackground="$herb->temperature->color_background" :colorText="$herb->temperature->color_text" :icon="$herb->temperature->symbol" />
                            <x-badge :content="$herb->planet->name" :colorBackground="$herb->planet->color_background" :colorText="$herb->planet->color_text" :icon="$herb->planet->symbol" />
                            <x-badge :content="$herb->element->name" :colorBackground="$herb->element->color_background" :colorText="$herb->element->color_text" :icon="$herb->element->symbol" />
                        </h6>
                        
                        <hr>
                        <p class="text-muted text-start">{{ Str::limit($herb->description, 120) }}</p>
                        
                        <ul class="list-group list-group-horizontal justify-content-center">
                            <li class="text-center list-group-item fw-bold d-flex align-items-center">
                                🌿 {{ $herb->alchemies->count() }} {{ Str::plural('alquimia', $herb->alchemies->count()) }} associada{{ $herb->alchemies->count() > 1 ? 's' : '' }}
                            </li>
                        </ul>
                        
                        <hr>
                        <div class="mt-auto text-center">
                            <a href="{{ route('website.erva', ['slug' => $herb->slug]) }}" class="btn btn-success w-100">✨ Ver Detalhes</a>
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
</section>
@stop