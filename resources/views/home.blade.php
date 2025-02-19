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
            <div class="card-header">
                <h3 class="card-title">📖 Compartilhe com a comunidade</h3>
            </div>
            <div class="card-body">
                <div class="post">
                    <div class="user-block">
                        <img class="img-circle" src="https://picsum.photos/200" alt="User Image">
                        <span class="username">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
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
                <div class="post">
                    <div class="user-block">
                        <img class="img-circle" src="https://picsum.photos/200" alt="User Image">
                        <span class="username">
                            <a href="#">Matheus Teixeira</a>
                        </span>
                        <span class="description">Compartilhado - 2h atrás</span>
                    </div>
                    <p>
                        Olá, pessoal! Hoje vamos falar sobre como fazer um feitiço de prosperidade...
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
            </div>
        </div>
    </section>
    <section class="col-sm-12 col-md-12 col-lg-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">🚨 Destaques</h3>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">
                                        O uso do chá de camomila para acalmar a mente e o corpo...
                                    </h5>
                                    <!-- Categorias visíveis -->
                                    <small>
                                        Há 2 horas
                                    </small>
                                </div>
                                <p class="mb-1">Olá, pessoal! Hoje vamos falar sobre como usar velas em feitiços...</p>
                                <small>Matheus Teixeira</small>
                                <div>
                                    <span class="badge bg-success text-dark">🍵 Chá</span>
                                    <span class="badge bg-info text-dark">🌿 Bem-estar</span>
                                </div>
                            </a>
                            <!-- Segunda sugestão de postagem com categorias -->
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">
                                        Como utilizar pedras para a proteção energética...
                                    </h5>
                                    <!-- Categorias visíveis -->
                                    <small>
                                        Há 1 dia
                                    </small>
                                </div>
                                <p class="mb-1">Este é um guia para entender como as pedras podem ser usadas em
                                    rituais...</p>
                                <small>Joana Silva</small>
                                <div>
                                    <span class="badge bg-warning text-dark">💎 Pedras</span>
                                    <span class="badge bg-primary text-light">🛡️ Proteção</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">❤️ Favoritos</h3>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Como usar velas em feitiços</h5>
                                    <small>3 dias atrás</small>
                                </div>
                                <p class="mb-1">Olá, pessoal! Hoje vamos falar sobre como usar velas em feitiços...</p>
                                <small>Matheus Teixeira</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Como fazer um feitiço de amor</h5>
                                    <small>1 semana atrás</small>
                                </div>
                                <p class="mb-1">Olá, pessoal! Hoje vamos falar sobre como fazer um feitiço de amor...
                                </p>
                                <small>Matheus Teixeira</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Como fazer um feitiço de prosperidade</h5>
                                    <small>2 semanas atrás</small>
                                </div>
                                <p class="mb-1">Olá, pessoal! Hoje vamos falar sobre como fazer um feitiço de
                                    prosperidade...</p>
                                <small>Matheus Teixeira</small>
                            </a>
                        </div>
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
