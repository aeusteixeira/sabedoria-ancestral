@props([
    'item',
    'route',
    'type' => 'default', // 'herb' ou 'alchemy'
])

<div class="mb-4 border-0 shadow-sm card h-100">
    <img src="{{ $item->image_url }}" class="card-img-top rounded-top"
        alt="{{ $item->name }}" title="{{ $item->name }}"
        style="height: 200px; object-fit: cover;">
    
    <div class="card-body d-flex flex-column">
        <h5 class="text-center card-title fw-bold text-dark">
            {{ $item->name }}
        </h5>

        <!-- Badges específicos para ervas e alquimias -->
        <h6 class="flex-wrap gap-2 mb-2 text-center d-flex justify-content-center">
            @if ($type === 'herb')
                <x-badge :content="$item->temperature->name" :colorBackground="$item->temperature->color_background" :colorText="$item->temperature->color_text" :icon="$item->temperature->symbol" />
                <x-badge :content="$item->planet->name" :colorBackground="$item->planet->color_background" :colorText="$item->planet->color_text" :icon="$item->planet->symbol" />
                <x-badge :content="$item->element->name" :colorBackground="$item->element->color_background" :colorText="$item->element->color_text" :icon="$item->element->symbol" />
            @elseif ($type === 'alchemy')
                <x-badge :content="$item->alchemyType->name" :colorBackground="$item->alchemyType->color_background" :colorText="$item->alchemyType->color_text" :icon="$item->alchemyType->symbol" />
            @endif
        </h6>

        <hr>

        <p class="text-muted text-start">
            {!! Str::limit($item->description, 120) !!}
        </p>

        <hr>

        <div class="mt-auto text-center">
            <a href="{{ route($route, ['slug' => $item->slug]) }}" class="btn btn-success w-100">
                {{ $type === 'herb' ? '🌿 Ver Detalhes' : '✨ Ver Detalhes' }}
            </a>
        </div>
    </div>
</div>
