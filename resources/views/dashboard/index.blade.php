@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Bem-vindo(a), {{ Auth::user()->name }}!</h1>
@stop

@section('content')
<main class="row">
    <section class="col-sm-12 col-md-12 col-lg-8">
        <!-- Card: Compartilhar com a Comunidade -->
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="card-title">📖 Compartilhe com a comunidade</h3>
            </div>
            <div class="card-body">
                <div class="post">
                    <div class="user-block">
                        <img class="img-circle" src="https://picsum.photos/200" alt="User Image">
                        <span class="username">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-text" data-toggle="modal"
                                data-target="#shareAlchemyModal">
                                O que você deseja compartilhar?
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="shareAlchemyModal" tabindex="-1" aria-labelledby="shareAlchemyModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="shareAlchemyModalLabel">
                                                O que você deseja compartilhar?
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="shareAlchemyModalInput">Compartilhe com a comunidade</label>
                                                <input type="text" class="form-control" id="shareAlchemyModalInput">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">
                                                Fechar
                                            </button>
                                            <button type="button" class="btn btn-primary">
                                                Compartilhar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card: Publicações Recentes -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">📝 Publicações Recentes</h3>
            </div>

            <div class="card-body">
                @forelse ($alchemies as $alchemie)
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle" src="https://picsum.photos/200" alt="User Image">
                            <span class="username">
                                <a href="#">
                                    {{ $alchemie->user->name }} <span class="badge badge-dark">Ancião</span>
                                </a>
                            </span>
                            <span class="description">{{ $alchemie->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="post-title">
                            {{ $alchemie->name }}
                        </h3>
                        <p>
                            {{ $alchemie->description }}
                        </p>
                        <p class="continue-reading">
                            <a href="#" class="mr-2 text-sm link-info">
                                Continue lendo...
                            </a>
                        </p>
                        <p>
                            <a href="#" class="mr-2 text-sm link-heart"><i class="mr-1 fas fa-heart"></i> 12</a>
                            <a href="#" class="mr-2 text-sm link-black"><i class="mr-1 fas fa-comment"></i> 4</a>
                        </p>
                    </div>
                @empty
                    <div class="post">
                        <p class="text-center">
                            Nenhuma publicação encontrada
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="col-sm-12 col-md-12 col-lg-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            🌟 Destaques
                        </h3>
                    </div>
                    <div class="card-body">
                        <x-astro-widget/>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">❤️ Favoritos</h3>
                    </div>
                    <div class="card-body">
                        <x-favorit-widget/>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@stop

@section('css')
{{-- Adicionar folhas de estilo extras --}}
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log("Bem-vindo ao painel de controle da Sabedoria Ancestral!");

</script>
@stop
