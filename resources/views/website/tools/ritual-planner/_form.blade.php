<!-- Formulário do Planejador de Rituais -->
<form id="ritualForm" class="ritual-form">
    @csrf
    <div class="row g-4">
        <!-- Seleção da Intenção -->
        <div class="col-md-8">
            <label for="intention" class="form-label">Qual é a sua intenção?</label>
            <select id="intention" name="intention" class="form-select" required>
                <option value="">Selecione sua intenção...</option>
                @foreach($intentions as $key => $intention)
                    <option value="{{ $key }}">{{ $intention['name'] }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Por favor, selecione sua intenção.
            </div>
        </div>

        <!-- Seleção da Data (Opcional) -->
        <div class="col-md-4">
            <label for="date" class="form-label">Data Desejada (Opcional)</label>
            <input type="date" class="form-control" id="date" name="date">
            <small class="text-muted">
                Deixe em branco para calcular a melhor data
            </small>
        </div>

        <!-- Botão de Calcular -->
        <div class="col-12 text-center">
            <button type="button" id="calculateButton" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-magic me-2"></i>
                Calcular Melhor Momento
            </button>
        </div>
    </div>
</form>

<!-- Container de Loading -->
<div id="loadingContainer" class="loading-container text-center my-5" style="display: none;">
    <div class="loading-spinner">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Carregando...</span>
        </div>
    </div>
    <p id="loadingMessage" class="loading-message mt-3">
        Analisando as fases da lua...
    </p>
</div>
