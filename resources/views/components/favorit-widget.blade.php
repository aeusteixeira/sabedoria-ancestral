<div>
    <div class="list-group">
        @forelse ($favorits as $favorite)
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
        @empty
            <p class="text-center list-group-item">
                Você ainda não possui nenhum favorito
            </p>
        @endforelse
    </div>
</div>
