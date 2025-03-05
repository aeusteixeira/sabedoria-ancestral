@extends('layouts.web')

@section('content')
<section>
    <div class="mb-4 border-0 rounded shadow-sm card">
        <div class="p-4 card-body">
            <div class="row">
                <!-- Imagem da Receita + Avaliação -->
                <div class="col-md-4 d-flex flex-column align-items-center">
                    <img src="{{ $alchemy->image_url }}" class="rounded shadow-sm card-img-top"
                        style="max-width: 100%; height: auto; object-fit: cover; border-radius: 12px;"
                        alt="{{ $alchemy->name }}" title="{{ $alchemy->name }}">

                    <!-- Avaliação e Comentários -->
                    <div class="mt-3 text-center w-100">
                        <h5 class="text-primary">⭐ Avaliações</h5>
                        <p class="text-secondary">Média: {{ $alchemy->rating }} / 5</p>
                        <a class="btn btn-sm btn-warning" href="#comentarios">Deixar Avaliação</a>
                    </div>

                    <!-- Botões de Interação -->
                    <div class="flex-wrap gap-2 mt-4 d-flex justify-content-center">
                        <button class="gap-1 btn btn-outline-danger btn-sm d-flex align-items-center">
                            ❤️ <span>Favoritar</span> <span class="fw-semibold">(0)</span>
                        </button>

                        <button class="gap-1 btn btn-outline-info btn-sm d-flex align-items-center">
                            🔗 <span>Compartilhar</span>
                        </button>

                        <button class="gap-1 btn btn-outline-secondary btn-sm d-flex align-items-center">
                            🖨️ <span>Imprimir</span>
                        </button>
                    </div>
                </div>

                <!-- Informações da Receita -->
                <div class="col-md-8">
                    <h2 class="mb-3 text-center text-success fw-bold">
                        🌿 {{ $alchemy->name }}
                    </h2>

                    <!-- Objetivo Mágico -->
                    <div class="text-center">
                        <x-badge :content="$alchemy->alchemyType->name" :colorBackground="$alchemy->alchemyType->color_background" :colorText="$alchemy->alchemyType->color_text" :icon="$alchemy->alchemyType->symbol" />
                    </div>

                    <p class="mt-3 text-justify text-muted">
                        {!! $alchemy->description !!}
                    </p>

                    <!-- Ingredientes Alquímicos -->
                    <div class="mt-3 row">
                        <div class="col-6">
                            <h5 class="text-primary">🌱 Ervas Utilizadas</h5>
                            <ul class="list-unstyled">
                                @forelse($alchemy->herbs as $herb)
                                    <li>✅ {{ $herb->name }}</li>
                                @empty
                                    <p class="text-muted">Nenhuma erva encontrada</p>
                                @endforelse
                            </ul>
                        </div>
                        <div class="col-6">
                            <h5 class="text-primary">💎 Cristais Utilizados</h5>
                            <ul class="list-unstyled">
                                @forelse($alchemy->stones as $crystal)
                                    <li>🔹 {{ $crystal->name }}</li>
                                @empty
                                    <p class="text-muted">Nenhum cristal encontrado</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Melhor Momento para Fazer -->
                    <div class="mt-3 row gy-2">
                        <div class="col-6">
                            <h5 class="text-primary">🌕 Melhor Lua</h5>
                            <p class="text-secondary">{{ $alchemy->moon->name }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="text-primary">📅 Melhor Dia</h5>
                            <p class="text-secondary">{{ $alchemy->dayOfWeek->name }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="text-primary">🕒 Melhor Hora Planetária</h5>
                            <p class="text-secondary">{{ $alchemy->hour->name }}</p>
                        </div>
                    </div>

                    <!-- Preparo -->
                    <div class="mt-3">
                        <h5 class="text-primary" id="preparo">🥄 Preparo</h5>
                        <p class="text-secondary">{!! $alchemy->preparation_method !!}</p>
                    </div>

                    <!-- Precauções -->
                    <div class="mt-3">
                        <h5 class="text-danger">⚠️ Precauções</h5>
                        <p class="text-secondary">{!! $alchemy->precautions !!}</p>
                    </div>

                    <!-- Aviso Importante -->
                    @if(stripos($alchemy->description, 'cura') !== false || stripos($alchemy->name, 'cura') !== false)
                        <div class="mt-3 alert alert-warning">
                            <strong>Aviso Importante:</strong> Esta receita contém promessas de cura. Consulte um
                            profissional de saúde antes de utilizar qualquer tratamento alternativo.
                        </div>
                    @endif
                </div>
            </div>

            <hr>

            <!-- Créditos -->
            <div class="mt-3 text-center text-muted small">
                <p class="mb-0">
                    Publicado por: <a href="#" class="fw-bold text-decoration-none">{{ $alchemy->user->name }}</a>
                    | Publicado em: <span class="fw-semibold">{{ $alchemy->created_at->format('d/m/Y') }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="rounded shadow-sm card" id="comentarios">
        <div class="card-body">
            <h4 class="mb-4 text-center fw-bold">💬 Comentários e Avaliações</h4>
            @auth
            <form action="{{ route('website.alchemy.comment', $alchemy->id) }}" method="POST">
                <input type="hidden" name="alchemy_id" value="{{ $alchemy->id }}">
                @csrf
                    <div class="mb-3">
                        <textarea class="form-control" name="content" placeholder="Deixe seu comentário..." rows="3"></textarea>
                    </div>

                    <!-- Avaliação com estrelas -->
                    <div class="mb-3">
                        <label class="d-block">
                            Avaliação:
                        </label>
                        <div class="rating">
                            <input type="radio" name="rating" id="star5" value="5"><label for="star5">
                                <i class="fas fa-star"></i>
                            </label>
                            <input type="radio" name="rating" id="star4" value="4"><label for="star4">
                                <i class="fas fa-star"></i>
                            </label>
                            <input type="radio" name="rating" id="star3" value="3"><label for="star3">
                                <i class="fas fa-star"></i>
                            </label>
                            <input type="radio" name="rating" id="star2" value="2"><label for="star2">
                                <i class="fas fa-star"></i>
                            </label>
                            <input type="radio" name="rating" id="star1" value="1"><label for="star1">
                                <i class="fas fa-star"></i>
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="px-4 btn btn-primary">Comentar</button>
                    </div>
                </form>
            @else
                <div class="d-flex justify-content-center">
                    <p>
                        <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">
                            Faça login para comentar e avaliar
                        </a>
                    </p>
                </div>
            @endauth

            <hr class="my-4">

            <!-- Comentários -->
            @forelse ($alchemy->comments as $comment)
                @if ($comment->parent_id == null)
                    <div class="mb-3 shadow-sm card">
                        <div class="card-body">
                            <div class="mb-2 d-flex align-items-center">
                                <img src="{{ $comment->user->profile_image }}" class="rounded-circle me-3" alt="{{ $comment->user->name }}" style="width: 60px; height: 60px;">
                                <div>
                                    <h6 class="mb-0">
                                        <a href="#" class="text-decoration-none text-dark fw-semibold">
                                            {{ $comment->user->name }}

                                            @if ($comment->user->id == auth()->id())
                                                <span class="badge bg-secondary">Você</span>
                                            @endif
                                        </a>
                                    </h6>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            <!-- Exibir estrelas de avaliação -->
                            <div class="mb-2">
                                {!! str_repeat('⭐', $comment->rating) !!}
                            </div>

                            <p class="mb-2">{{ $comment->content }}</p>

                            <div class="mt-3 d-flex align-items-center">
                                <a href="#" class="text-danger text-decoration-none me-3 like-comment" data-id="{{ $comment->id }}">
                                    <i class="fas fa-heart me-1"></i> {{ $comment->likes_count ?? 0 }}
                                </a>

                                <a href="#" class="text-primary text-decoration-none me-3 reply-btn" data-id="{{ $comment->id }}">
                                    <i class="fas fa-reply"></i> Responder
                                </a>
                            </div>

                            <!-- Campo de resposta escondido inicialmente -->
                            <div class="mt-3 reply-box d-none" id="reply-box-{{ $comment->id }}">
                                <form action="{{ route('website.alchemy.comment', $alchemy->id) }}" method="POST">
                                    <input type="hidden" name="alchemy_id" value="{{ $alchemy->id }}">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea class="form-control" name="content" placeholder="Escreva sua resposta..." rows="2"></textarea>
                                    <div class="mt-2 text-end">
                                        <button type="submit" class="btn btn-sm btn-primary">Enviar Resposta</button>
                                        <button type="button" class="btn btn-sm btn-secondary close-reply" data-id="{{ $comment->id }}">Cancelar</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Respostas aos comentários -->
                            @if ($comment->replies->count() > 0)

                                        @foreach ($comment->replies as $reply)
                                        <div class="mt-2 card bg-light" id="respostas">
                                            <div class="card-body">
                                            <div class="mb-2 d-flex align-items-center">
                                                <img src="{{ $reply->user->profile_image }}" class="rounded-circle me-3" alt="{{ $reply->user->name }}" style="width: 60px; height: 60px;">
                                                <div>
                                                    <h6 class="mb-0">
                                                        <a href="#" class="text-decoration-none text-dark fw-semibold">
                                                            {{ $reply->user->name }}
                                                            @if($reply->user->id == $alchemy->user_id)
                                                                <span class="badge bg-primary">Autor</span>
                                                            @endif
                                                        </a>
                                                    </h6>
                                                    <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <p class="mb-2">{{ $reply->content }}</p>
                                            <div class="mt-3 d-flex align-items-center">
                                                <a href="#" class="text-danger text-decoration-none me-3">
                                                    <i class="fas fa-heart me-1"></i> {{ $reply->likes_count ?? 0 }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-center text-muted">
                    Opa, parece que ninguém comentou ainda! Que tal ser o primeiro?
                </p>
            @endforelse

        </div>
    </div>


</section>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Estilos para as estrelas -->
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 1rem;
        cursor: pointer;
        transition: color 0.2s;
    }

    .rating input:checked ~ label {
        color: gold;
    }
</style>
@stop

@section('js')
<script src="{{ asset('js/ervas.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Quando clicar no botão "Responder"
        document.querySelectorAll('.reply-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                let commentId = this.getAttribute('data-id');
                let replyBox = document.getElementById(`reply-box-${commentId}`);

                // Esconde todos os outros reply-box antes de exibir o atual
                document.querySelectorAll('.reply-box').forEach(box => box.classList.add('d-none'));

                // Exibe o campo de resposta
                replyBox.classList.remove('d-none');
            });
        });

        // Quando clicar no botão "Cancelar"
        document.querySelectorAll('.close-reply').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                let commentId = this.getAttribute('data-id');
                let replyBox = document.getElementById(`reply-box-${commentId}`);
                replyBox.classList.add('d-none');
            });
        });
    });
</script>

@stop
