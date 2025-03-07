@props(['service'])

<div class="shadow-sm card h-100">
    @if($service->image)
        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->title }}">
    @endif

    <div class="card-body d-flex flex-column">
        <h5 class="text-center fw-bold card-title">{{ $service->title }}</h5>

        <p class="text-muted"><i class="bi bi-file-text"></i> {!! Str::limit($service->description, 100) !!}</p>

        <p><strong>💰 Valor:</strong>
            {{ $service->price ? 'R$ ' . number_format($service->price, 2, ',', '.') : 'A combinar' }}
        </p>

        <p><strong>📍 Tipo:</strong> {{ ucfirst($service->type) }}</p>
        <p><strong>📞 Contato:</strong> {{ $service->contact_info }}</p>

        <div class="gap-2 mt-auto d-flex">
            <a href="{{ route('website.service.show', ['slug' => $service->slug]) }}" class="btn btn-success btn-sm">
                <i class="bi bi-info-circle"></i>
                Visualizar
            </a>

            @if ($service->user_id == auth()->id())
                <a href="{{ route('website.service.edit', ['slug' => $service->slug]) }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-pencil-square"></i>
                    Editar
                </a>
                <form action="{{ route('website.service.destroy', ['slug' => $service->slug]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                        Excluir
                    </button>
                </form>
                <button class="btn btn-primary btn-sm share-btn" data-url="{{ url('/servico/' . $service->slug) }}" data-name="{{ $service->title }}">
                    <i class="bi bi-share"></i>
                    Compartilhar
                </button>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.share-btn').forEach(button => {
            button.addEventListener('click', function () {
                const shareUrl = this.getAttribute('data-url');

                if (navigator.share) {
                    navigator.share({
                        title: "Confira o meu serviço de " + this.getAttribute('data-name'),
                        text: "Dê uma olhada nesse serviço incrível no Sabedoria Ancestral.",
                        url: shareUrl
                    }).catch(err => console.error("Erro ao compartilhar:", err));
                } else {
                    navigator.clipboard.writeText(shareUrl).then(() => {
                        alert("🔗 Link copiado para a área de transferência!");
                    }).catch(err => console.error("Erro ao copiar:", err));
                }
            });
        });
    });
</script>
