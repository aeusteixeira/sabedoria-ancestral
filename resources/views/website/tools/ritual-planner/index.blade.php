@extends('layouts.web')

@section('content')
<x-header-page
    complement="Ferramentas"
    title="Planejador de Rituais"
    description="Planeje seus rituais considerando as melhores influências astrológicas e elementos"
/>

<div class="container py-4">
    <!-- Links Rápidos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">🌿 Explore Mais Recursos Mágicos</h5>
                            <p class="mb-0">Descubra ervas, cristais e rituais ancestrais</p>
                        </div>
                        <div>
                            <a href="{{ route('website.herb.index') }}" class="btn btn-light me-2">
                                🌿 Ervas
                            </a>
                            <a href="#" class="btn btn-light">
                                💎 Cristais
                            </a>
                            <a href="#" class="btn btn-light">
                                🔮 Alquimias
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Formulário de Planejamento -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div id="ritualForm" class="needs-validation" novalidate>
                        <!-- Intenção -->
                        <div class="mb-4">
                            <label for="intention" class="form-label">✨ Qual é sua intenção?</label>
                            <select class="form-select" id="intention" name="intention" required>
                                <option value="">Selecione sua intenção</option>
                                @foreach($intentions as $key => $intention)
                                <option value="{{ $key }}">{{ $intention['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Escolha a intenção principal do seu ritual e deixe que a sabedoria ancestral guie o resto</div>
                        </div>

                        <!-- Data Pretendida -->
                        <div class="mb-4">
                            <label for="date" class="form-label">📅 Data Pretendida (Opcional)</label>
                            <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}">
                            <div class="form-text">Se não selecionar uma data, calcularemos automaticamente a melhor data para seu ritual</div>
                        </div>

                        <!-- Botão de Cálculo -->
                        <div class="d-grid">
                            <button type="button" id="calculateButton" class="btn btn-success">
                                ✨ Planejar Ritual
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resultado do Planejamento -->
        <div class="col-lg-8">
            <!-- Loading Místico -->
            <div id="loadingContainer" style="display: none;">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center">
                        <div class="loading-crystal mb-4">
                            <i class="fas fa-gem fa-3x fa-spin text-primary"></i>
                        </div>
                        <h4 class="mb-4">Consultando os Astros...</h4>
                        <div id="loadingMessage" class="text-muted">
                            Analisando as fases da lua...
                        </div>
                    </div>
                </div>
            </div>

            <div id="resultContainer" style="display: none;">
                <!-- Melhor Momento -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            ⏰ Melhor Momento
                        </h4>
                        <div class="best-time-info">
                            <!-- Melhor Data -->
                            <div class="row align-items-center mb-4">
                                <div class="col-md-6">
                                    <div class="time-display text-center best-date">
                                        <div class="display-4" id="bestHour">--:--</div>
                                        <div class="text-success fw-bold" id="bestDate">Melhor data</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="planetary-info">
                                        <p class="mb-2">
                                            🌙
                                            Fase Lunar: <span id="bestMoonPhase">-</span>
                                        </p>
                                        <p class="mb-2">
                                            🌍
                                            Hora Planetária: <span id="bestPlanetaryHour">-</span>
                                        </p>
                                        <p class="mb-2">
                                            🧭
                                            Direção Mágica: <span id="bestMagicalDirection">-</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Selecionada (se houver) -->
                            <div id="selectedDateContainer" style="display: none;">
                                <hr class="my-4">
                                <h5 class="mb-4">Data Selecionada</h5>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="time-display text-center selected-date">
                                            <div class="display-4" id="selectedHour">--:--</div>
                                            <div class="text-muted" id="selectedDate">Data escolhida</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="planetary-info">
                                            <p class="mb-2">
                                                🌙
                                                Fase Lunar: <span id="selectedMoonPhase">-</span>
                                            </p>
                                            <p class="mb-2">
                                                🌍
                                                Hora Planetária: <span id="selectedPlanetaryHour">-</span>
                                            </p>
                                            <div id="moonPhaseAlert" class="alert mt-3 mb-0" style="display: none;">
                                                <span id="moonPhaseMessage"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Materiais Recomendados -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                             🧪 Materiais Recomendados
                        </h4>
                        <div class="row">
                            <!-- Ervas -->
                            <div class="col-md-6 mb-4">
                                <h5 class="mb-3">🌿 Ervas Sugeridas</h5>
                                <div id="recommendedHerbs" class="recommended-items">
                                    <!-- Preenchido via JavaScript -->
                                </div>
                            </div>
                            <!-- Cristais -->
                            <div class="col-md-6 mb-4">
                                <h5 class="mb-3">💎 Cristais Sugeridos</h5>
                                <div id="recommendedStones" class="recommended-items">
                                    <!-- Preenchido via JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Passos do Ritual -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                             📜 Passos do Ritual
                        </h4>
                        <div class="ritual-steps">
                            <!-- Preparação -->
                            <div class="step-section mb-4">
                                <h5 class="step-title">
                                     🧹 Preparação
                                </h5>
                                <div id="preparationSteps" class="step-content">
                                    <!-- Preenchido via JavaScript -->
                                </div>
                            </div>

                            <!-- Durante o Ritual -->
                            <div class="step-section mb-4">
                                <h5 class="step-title">
                                     ⭐ Durante o Ritual
                                </h5>
                                <div id="ritualSteps" class="step-content">
                                    <!-- Preenchido via JavaScript -->
                                </div>
                            </div>

                            <!-- Pós-Ritual -->
                            <div class="step-section">
                                <h5 class="step-title">
                                     🌙 Pós-Ritual
                                </h5>
                                <div id="postRitualSteps" class="step-content">
                                    <!-- Preenchido via JavaScript -->
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn btn-outline-primary" id="saveRitual">
                                 <i class="fas fa-save"></i> Salvar Ritual
                            </button>
                            <button class="btn btn-outline-primary" id="printRitual">
                                <i class="fas fa-print"></i> Imprimir
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Informações Místicas -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            🌟 Informações Místicas do Dia
                        </h4>
                        <p class="text-muted mb-4">
                            Cada dia possui influências únicas baseadas nos astros, números e elementos.
                            Estas informações são da melhor data calculada para seu ritual,
                            alinhando as energias celestiais com sua intenção.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mystical-info-card">
                                    <h5 class="mb-3">📅 Influências do Dia</h5>
                                    <p class="text-muted mb-3">
                                        Cada dia da semana é regido por um planeta específico, que traz
                                        suas próprias energias, cores e números para potencializar seu ritual.
                                    </p>
                                    <ul class="list-unstyled">
                                        <li class="mb-3">
                                            <i class="fas fa-calendar-day"></i>
                                            <strong>Dia da Semana:</strong> <span id="weekDay">-</span>
                                            <small class="text-muted d-block ms-4">Este dia é regido por <span id="weekDayPlanet">-</span>, trazendo energias de <span id="weekDayEnergies">-</span></small>
                                        </li>
                                        <li class="mb-3">
                                            <i class="fas fa-palette"></i>
                                            <strong>Cores do Dia:</strong> <span id="dayColor">-</span>
                                            <small class="text-muted d-block ms-4">Estas cores amplificam as energias do planeta regente</small>
                                        </li>
                                        <li class="mb-3">
                                            <i class="fas fa-hashtag"></i>
                                            <strong>Número do Dia:</strong> <span id="dayNumber">-</span>
                                            <small class="text-muted d-block ms-4">Este número vibra em harmonia com as energias do dia</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mystical-info-card">
                                    <h5 class="mb-3">🌍 Influências Planetárias</h5>
                                    <p class="text-muted mb-3">
                                        A posição dos astros neste dia traz energias específicas
                                        que influenciam diretamente o sucesso do seu ritual.
                                    </p>
                                    <ul class="list-unstyled">
                                        <li class="mb-3">
                                            <i class="fas fa-sun"></i>
                                            <strong>Sol em:</strong> <span id="sunSign">-</span>
                                            <small class="text-muted d-block ms-4">Influencia sua força vital e propósito</small>
                                        </li>
                                        <li class="mb-3">
                                            <i class="fas fa-moon"></i>
                                            <strong>Lua em:</strong> <span id="moonSign">-</span>
                                            <small class="text-muted d-block ms-4">Afeta suas emoções e intuição</small>
                                        </li>
                                        <li class="mb-3">
                                            <i class="fas fa-star"></i>
                                            <strong>Ascendente:</strong> <span id="ascendant">-</span>
                                            <small class="text-muted d-block ms-4">Determina como as energias se manifestam</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Materiais Complementares -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            🎨 Materiais Complementares
                        </h4>
                        <p class="text-muted mb-4">
                            Para potencializar seu ritual, recomendamos materiais específicos que se
                            alinham com sua intenção e os elementos escolhidos. Cada item foi
                            cuidadosamente selecionado para amplificar as energias do seu trabalho místico.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="complementary-materials">
                                    <h5 class="mb-3">🕯️ Velas e Incensos</h5>
                                    <p class="text-muted mb-3">
                                        Velas e incensos são ferramentas poderosas que ajudam a criar
                                        a atmosfera adequada e canalizar as energias desejadas.
                                    </p>
                                    <div id="candlesAndIncense" class="recommended-items">
                                        <!-- Preenchido via JavaScript -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="complementary-materials">
                                    <h5 class="mb-3">🎵 Ambientação</h5>
                                    <p class="text-muted mb-3">
                                        A ambientação correta ajuda a criar um espaço sagrado e
                                        harmonioso para seu ritual, amplificando sua conexão espiritual.
                                    </p>
                                    <div id="ambientation" class="recommended-items">
                                        <!-- Preenchido via JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visualizador Lunar -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            🌙 Visualizador Lunar
                        </h4>
                        <p class="text-muted mb-4">
                            A fase da Lua é fundamental para o sucesso do seu ritual. Cada fase lunar
                            possui energias específicas que podem potencializar diferentes tipos de
                            trabalhos místicos. A iluminação e idade da Lua influenciam diretamente
                            na força e natureza das energias disponíveis.
                        </p>
                        <div class="moon-visualizer text-center">
                            <div class="moon-phase-display mb-3">
                                <div class="moon-icon" id="moonVisualizer">
                                    <!-- Preenchido via JavaScript -->
                                </div>
                            </div>
                            <div class="moon-details">
                                <p class="mb-2">
                                    <i class="fas fa-percentage"></i>
                                    Iluminação: <span id="moonIllumination">-</span>
                                    <small class="text-muted d-block">Porcentagem da Lua iluminada, influencia a intensidade das energias</small>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-clock"></i>
                                    Idade da Lua: <span id="moonAge">-</span>
                                    <small class="text-muted d-block">Dias desde a última Lua Nova, cada idade traz diferentes potenciais</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recursos Educativos -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            📚 Aprenda Mais
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="learning-resources">
                                    <h5 class="mb-3">📖 Artigos Relacionados</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-book-open"></i>
                                                Como Preparar seu Altar
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-book-open"></i>
                                                Guia de Cores Místicas
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-book-open"></i>
                                                Influências Planetárias
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="learning-resources">
                                    <h5 class="mb-3">🎥 Vídeos e Recursos</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-video"></i>
                                                Meditação Guiada
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-file-pdf"></i>
                                                PDF: Guia Completo
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-book"></i>
                                                Glossário Místico
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('css')
    @include('website.tools.ritual-planner._styles')
@endsection

@section('js')
    @include('website.tools.ritual-planner._scripts')
@endsection

@endsection
