@extends('layouts.web')

@section('title', 'Sabedoria Ancestral')

@section('subtitle')
Conecte-se com a natureza e com o universo
@stop

@section('content')
<section>
    <div class="mb-4 border-0 rounded shadow-sm card">
        <div class="p-4 card-body">
            <div class="row">
                <!-- Imagem da Erva + Avaliação -->
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <img src="{{ $herb->image_url }}" class="rounded shadow-sm card-img-top"
                        style="max-width: 100%; height: auto; object-fit: cover; border-radius: 12px;"
                        alt="{{ $herb->name }}" title="{{ $herb->name }}">

                    <!-- Botões de Interação -->
                    <div class="flex-wrap gap-2 mt-4 d-flex justify-content-center">
                        <button class="gap-1 btn btn-outline-danger btn-sm d-flex align-items-center">
                            ❤️ <span>Favoritar</span> <span class="fw-semibold">(0)</span>
                        </button>

                        <button class="gap-1 btn btn-outline-info btn-sm d-flex align-items-center">
                            🔗 <span>Compartilhar</span>
                        </button>
                    </div>
                </div>

                <!-- Informações da Erva -->
                <div class="col-md-8">
                    <h2 class="mb-3 text-center text-success fw-bold">
                        🌿 {{ $herb->name }}
                    </h2>

                    <p class="mt-3 text-justify text-muted">
                        {!! $herb->description !!}
                    </p>

                    <div class="mt-3 row">
                        <div class="mb-2 col-sm-12 col-md-6">
                            <h5 class="text-primary">
                                🌡️ Temperatura:
                            </h5>
                                <x-badge :content="$herb->temperature->name" :colorBackground="$herb->temperature->color_background" :colorText="$herb->temperature->color_text" :icon="$herb->temperature->symbol" />
                        </div>
                        <div class="mb-2 col-sm-12 col-md-6">
                            <h5 class="text-primary">
                                🪐 Planeta Regente:
                            </h5>
                                <x-badge :content="$herb->planet->name" :colorBackground="$herb->planet->color_background" :colorText="$herb->planet->color_text" :icon="$herb->planet->symbol" />
                        </div>
                        <div class="mb-2 col-sm-12 col-md-6">
                            <h5 class="text-primary">
                                🪨 Elemento Regente:
                            </h5>
                            <ul class="list-unstyled">
                                    <x-badge :content="$herb->element->name" :colorBackground="$herb->element->color_background" :colorText="$herb->element->color_text" :icon="$herb->element->symbol" />
                            </ul>
                        </div>
                        <div class="mb-2 col-sm-12 col-md-6">
                            <h5 class="text-primary">
                                🪬 Chakras Regentes:
                            </h5>
                            <div class="flex-wrap gap-2 d-flex">
                                @forelse ($herb->chakras as $chakra)
                                    <x-badge :content="$chakra->name" :colorBackground="$chakra->color_background" :colorText="$chakra->color_text" :icon="$chakra->symbol" />
                                @empty
                                    <p class="text-muted">Nenhum chakra encontrado</p>
                                @endforelse
                            </div>
                        </div>
                        @if ($herb->user_id == auth()->user()->id)
                        <hr>
                            <div class="d-flex">
                                <a href="{{ route('website.herb.edit', ['slug' => $herb->slug]) }}" class="btn btn-primary btn-sm me-2">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>
                                <!-- Botão para exclusão abre modal para confirmar o nome, similar ao deletar repo no git -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fa fa-trash"></i> Excluir
                                </button>

                                <!-- Modal de Exclusão -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-danger">
                                            <div class="text-white modal-header bg-danger">
                                                <h5 class="modal-title" id="deleteModalLabel">⚠️ Confirmar Exclusão</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                            </div>
                                            <div class="text-center modal-body">
                                                <p class="fs-5">Você está prestes a excluir <strong>"{{ $herb->name }}"</strong>.</p>
                                                <p class="text-danger fw-bold">Essa ação é irreversível!</p>

                                                <!-- Campo de Confirmação -->
                                                <p class="mt-3">Para confirmar, digite o nome da erva abaixo:</p>
                                                <input type="text" class="text-center form-control" id="name_confirme" placeholder="{{ $herb->name }}">

                                                <small class="text-danger d-none" id="error-message">O nome digitado não confere.</small>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fa fa-times"></i> Cancelar
                                                </button>
                                                <form action="{{ route('website.herb.destroy', ['id' => $herb->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="delete-button" class="btn btn-danger" disabled>
                                                        <i class="fa fa-trash"></i> Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Script de Validação -->
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const name = @json($herb->name);
                                        const input = document.getElementById('name_confirme');
                                        const errorMessage = document.getElementById('error-message');
                                        const deleteButton = document.getElementById('delete-button');

                                        input.addEventListener('input', function () {
                                            if (this.value.trim() === name.trim()) {
                                                this.classList.remove('is-invalid');
                                                errorMessage.classList.add('d-none');
                                                deleteButton.removeAttribute('disabled');
                                            } else {
                                                this.classList.add('is-invalid');
                                                errorMessage.classList.remove('d-none');
                                                deleteButton.setAttribute('disabled', 'true');
                                            }
                                        });
                                    });
                                </script>

                            </div>
                        @endif
                    </div>


                </div>
            </div>
            <hr>
            <!-- Informações Detalhadas -->
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-primary">📜 História e Origem</h5>
                    <p class="text-secondary">{{ $herb->history_origin }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-primary">🔮 Usos Mágicos</h5>
                    <p class="text-secondary">{{ $herb->magical_uses }}</p>
                </div>
            </div>

            <div class="mt-3 row">
                <div class="col-md-6">
                    <h5 class="text-primary">🌱 Usos Biológicos</h5>
                    <p class="text-secondary">{{ $herb->biological_uses }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-danger">⚠️ Precauções</h5>
                    <p class="text-secondary">{{ $herb->precautions }}</p>
                </div>
            </div>
            <hr>
            <!-- Créditos -->
            <div class="mt-3 text-center text-muted small">
                <p class="mb-0">
                    Publicado por: <a href="{{ route('website.profile.index', ['username' => $herb->user->username]) }}" class="fw-bold text-decoration-none">{{ $herb->user->name }}</a>
                    | Publicado em: <span class="fw-semibold">{{ $herb->created_at->format('d/m/Y') }}</span>
                    | Revisado por <span class="fw-semibold">2 pessoas</span>.
                </p>
            </div>

            <hr>

            <!-- Receitas Mágicas com a Erva -->
            <h3 class="mb-3 text-center">✨ Receitas Mágicas com {{ $herb->name }}</h3>
            <div class="row">
                @forelse ($herb->alchemies as $alchemy)
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                        <x-card :item="$alchemy" route="website.alchemy.show" type="alchemy" />
                    </div>
                @empty
                    <p class="text-center text-muted">Nenhuma receita encontrada para esta erva.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
<audio id="confettiSound" preload="auto">
    <source src="https://matheusteixeira.com.br/wp-content/uploads/2025/03/Confetti-2.mp3" type="audio/mpeg">
</audio>
@stop

@section('js')
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

                // Obtém o elemento de áudio do HTML
                let confettiSound = document.getElementById("confettiSound");

                // Ajusta o volume e toca o som
                confettiSound.volume = 0.5; // 50% do volume
                confettiSound.play();

                // Define a duração da animação (5 segundos)
                const end = Date.now() + 1 * 1000;

                // Cores dos confetes
                const colors = ["#ff0000", "#ff9100", "#ffff00", "#00ff00", "#0091ff", "#b400ff"];

                // Função para animar os confetes
                (function frame() {
                    confetti({
                        particleCount: 3,
                        angle: 60,
                        spread: 55,
                        origin: { x: 0 },
                        colors: colors,
                    });

                    confetti({
                        particleCount: 3,
                        angle: 120,
                        spread: 55,
                        origin: { x: 1 },
                        colors: colors,
                    });

                    if (Date.now() < end) {
                        requestAnimationFrame(frame);
                    }
                })();
        });
    </script>
@endif
@stop
