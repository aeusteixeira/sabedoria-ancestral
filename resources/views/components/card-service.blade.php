@props(['service'])

<div class="mb-3 shadow-sm card h-100">
    <div class="card-body d-flex flex-column">
        <h5 class="text-center fw-bold card-title">{{ $service->title }}</h5>
        
        <p class="text-muted">{{ Str::limit($service->description, 100) }}</p>

        <p><strong>💰 Valor:</strong> 
            {{ $service->price ? 'R$ ' . number_format($service->price, 2, ',', '.') : 'A combinar' }}
        </p>
        
        <p><strong>📍 Tipo:</strong> {{ ucfirst($service->type) }}</p>
        <p><strong>📞 Contato:</strong> {{ $service->contact_info }}</p>

        <div class="gap-2 mt-auto d-flex">
            <a href="#" class="btn btn-success btn-sm">Ver detalhes</a>
            @if ($service->user_id == auth()->id())
                <a href="#" class="btn btn-secondary btn-sm">Editar</a>
                <a href="#" class="btn btn-danger btn-sm">Excluir</a>
                <a href="#" class="btn btn-primary btn-sm">Compartilhar</a>
            @endif
        </div>
    </div>
</div>
