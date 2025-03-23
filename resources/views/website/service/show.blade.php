@extends('layouts.web')

@section('content')
<x-header-page title="💼 {{ $service->title }}" description="Detalhes completos sobre este serviço esotérico."/>

<section class="container">
    <div class="p-4 rounded shadow-sm bg-light">
        <div class="row g-4">
            <!-- Imagem do Serviço -->
            <div class="col-md-5">
                <div class="border-0 shadow-sm card">
                    <img src="{{ $service->image ? Storage::url($service->image) : 'https://placehold.co/600x400?text=' . urlencode($service->title) }}"
                         class="rounded card-img-top" alt="{{ $service->title }}">
                </div>
                <div class="mt-3 text-center w-100">
                    <h5 class="text-primary">⭐ Avaliações</h5>
                    <p class="text-secondary">Média: 4.5 / 5</p>
                    <a class="btn btn-sm btn-warning" href="#comentarios">Deixar Avaliação</a>
                </div>
            </div>

            <!-- Detalhes do Serviço -->
            <div class="col-md-7">
                <h2 class="fw-bold">{{ $service->title }}</h2>
                <p class="text-muted">{!! $service->description !!}</p>
                <hr>

                <p><strong>💰 Valor:</strong> {{ $service->price ? 'R$ ' . number_format($service->price, 2, ',', '.') : 'A combinar' }}</p>
                <p><strong>📍 Tipo:</strong> {{ ucfirst($service->type) }}</p>

                @if ($service->type === 'presencial')
                    <p><strong>🌎 Localização:</strong> {{ $service->city }}, {{ $service->state }}</p>
                @endif

                <x-contact-button :type="$service->contact_type" :info="$service->contact_info" />
                @if ($service->user_id == auth()->id())
                    <hr>
                    <div class="gap-2 d-flex">
                            <a href="{{ route('website.service.edit', ['slug' => $service->slug]) }}" class="btn btn-secondary btn-sm">
                                <i class="fa fa-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route('website.service.destroy', ['slug' => $service->slug]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                    Excluir
                                </button>
                            </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Informações do Usuário -->
    <div class="p-4 mt-4 bg-white rounded shadow-sm">
        <h4 class="fw-bold">👤 Prestador do Serviço</h4>
        <div class="d-flex align-items-center">
            <img src="{{ $service->user->profile_image }}" class="rounded-circle me-3" width="60" height="60" alt="Avatar">
            <div>
                <h5 class="mb-1">
                    <a href="{{ route('website.profile.index', $service->user->username) }}" class="text-decoration-none text-dark">
                        {{ $service->user->name }}
                    </a>
                </h5>
                <p class="mb-0 text-muted">
                    {{ $service->user->description }}
                </p>
            </div>
        </div>
    </div>

    <div class="p-4 mt-4 bg-white rounded shadow-sm" id="comentarios">
        <div class="card-body">
            <h4 class="mb-4 text-center fw-bold">💬 Comentários e Avaliações</h4>
            @auth
            <form action="{{ route('website.service.comment', $service->id) }}" method="POST">
                <input type="hidden" name="service_id" value="{{ $service->id }}">
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
            @forelse ($service->comments as $comment)
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
                                <form action="{{ route('website.service.comment', $service->id) }}" method="POST">
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
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
                                                            @if($reply->user->id == $service->user_id)
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
@endsection

@section(section: 'css')
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
