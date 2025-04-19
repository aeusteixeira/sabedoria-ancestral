<!-- Container de Resultados -->
<div id="resultContainer" class="results-container mt-5" style="display: none;">
    <div class="row g-4">
        <!-- Melhor Momento -->
        <div class="col-12">
            <div class="card best-moment-card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">
                        <i class="fas fa-star me-2"></i>
                        Melhor Momento para seu Ritual
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <strong>Data:</strong>
                                <span id="bestDate">-</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="fas fa-moon"></i>
                                <strong>Fase Lunar:</strong>
                                <span id="bestMoonPhase">-</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <strong>Hora Planetária:</strong>
                                <span id="bestHour">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Selecionada (se houver) -->
        <div id="selectedDateContainer" class="col-12" style="display: none;">
            <div class="card selected-date-card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-calendar-check me-2"></i>
                        Informações da Data Selecionada
                    </h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <strong>Data:</strong>
                                <span id="selectedDate">-</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="fas fa-moon"></i>
                                <strong>Fase Lunar:</strong>
                                <span id="selectedMoonPhase">-</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <strong>Hora Planetária:</strong>
                                <span id="selectedHour">-</span>
                            </div>
                        </div>
                    </div>
                    <div id="moonPhaseAlert" class="alert alert-info mt-3 mb-0" style="display: none;">
                        <p id="moonPhaseMessage" class="mb-0"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações Místicas -->
        <div class="col-md-6">
            <div class="card mystical-info-card h-100">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-sun me-2"></i>
                        Informações Místicas
                    </h4>
                    <div class="mystical-info">
                        <div class="info-group">
                            <div class="info-item">
                                <i class="fas fa-calendar-week"></i>
                                <strong>Dia da Semana:</strong>
                                <span id="weekDay">-</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-planet"></i>
                                <strong>Planeta Regente:</strong>
                                <span id="weekDayPlanet">-</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-palette"></i>
                                <strong>Cores do Dia:</strong>
                                <span id="dayColor">-</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-hashtag"></i>
                                <strong>Número do Dia:</strong>
                                <span id="dayNumber">-</span>
                            </div>
                        </div>
                        <div class="info-group mt-3">
                            <div class="info-item">
                                <i class="fas fa-sun"></i>
                                <strong>Sol em:</strong>
                                <span id="sunSign">-</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-moon"></i>
                                <strong>Lua em:</strong>
                                <span id="moonSign">-</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-star"></i>
                                <strong>Ascendente:</strong>
                                <span id="ascendant">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Materiais Recomendados -->
        <div class="col-md-6">
            <div class="card materials-card h-100">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-mortar-pestle me-2"></i>
                        Materiais Recomendados
                    </h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5 class="subtitle">
                                <i class="fas fa-leaf me-2"></i>
                                Ervas
                            </h5>
                            <div id="recommendedHerbs" class="recommended-items">
                                <div class="text-muted">Carregando...</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="subtitle">
                                <i class="fas fa-gem me-2"></i>
                                Cristais
                            </h5>
                            <div id="recommendedStones" class="recommended-items">
                                <div class="text-muted">Carregando...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visualizador Lunar -->
        <div class="col-12">
            <div class="card moon-viewer-card">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">
                        <i class="fas fa-moon me-2"></i>
                        Visualizador Lunar
                    </h4>
                    <div class="row">
                        <!-- Informações Básicas -->
                        <div class="col-md-4 text-center mb-4">
                            <div class="moon-phase-display">
                                <div class="moon-icon display-1 mb-3" id="moonIcon">-</div>
                                <h5 class="moon-phase-name" id="moonPhaseName">-</h5>
                                <div class="moon-stats">
                                    <p class="mb-2">
                                        <i class="fas fa-adjust me-2"></i>
                                        Iluminação: <span id="moonIllumination">-</span>
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-hourglass-half me-2"></i>
                                        Idade da Lua: <span id="moonAge">-</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Descrição e Influências -->
                        <div class="col-md-4 mb-4">
                            <div class="moon-description">
                                <h5 class="subtitle mb-3">
                                    <i class="fas fa-book me-2"></i>
                                    Sobre esta Fase
                                </h5>
                                <p id="moonDescription" class="mb-4">-</p>
                                <div class="moon-influences">
                                    <h6 class="mb-2">Influências:</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-fire-alt me-2"></i>
                                            Energia: <span id="moonEnergy">-</span>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-atom me-2"></i>
                                            Elementos: <span id="moonElements">-</span>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-dharmachakra me-2"></i>
                                            Chakras: <span id="moonChakras">-</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-heart me-2"></i>
                                            Emoções: <span id="moonEmotions">-</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Recomendações -->
                        <div class="col-md-4">
                            <div class="moon-recommendations">
                                <h5 class="subtitle mb-3">
                                    <i class="fas fa-magic me-2"></i>
                                    Recomendações
                                </h5>
                                <div class="recommendations-content">
                                    <div class="mb-3">
                                        <h6 class="mb-2">
                                            <i class="fas fa-scroll me-2"></i>
                                            Rituais Ideais:
                                        </h6>
                                        <ul id="moonRituals" class="list-unstyled">
                                            <li>-</li>
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="mb-2">
                                            <i class="fas fa-gem me-2"></i>
                                            Cristais Sugeridos:
                                        </h6>
                                        <ul id="moonCrystals" class="list-unstyled">
                                            <li>-</li>
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="mb-2">
                                            <i class="fas fa-leaf me-2"></i>
                                            Ervas Mágicas:
                                        </h6>
                                        <ul id="moonHerbs" class="list-unstyled">
                                            <li>-</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h6 class="mb-2">
                                            <i class="fas fa-hat-wizard me-2"></i>
                                            Práticas Recomendadas:
                                        </h6>
                                        <ul id="moonPractices" class="list-unstyled">
                                            <li>-</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passos do Ritual -->
        <div class="col-12">
            <div class="card ritual-steps-card">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">
                        <i class="fas fa-book-open me-2"></i>
                        Passos do Ritual
                    </h4>
                    <div class="row g-4">
                        <!-- Preparação -->
                        <div class="col-md-4">
                            <div class="step-section">
                                <h5 class="step-title">
                                    <i class="fas fa-list-check me-2"></i>
                                    Preparação
                                </h5>
                                <div id="preparationSteps" class="step-content">
                                    <div class="text-muted">Carregando...</div>
                                </div>
                            </div>
                        </div>

                        <!-- Durante o Ritual -->
                        <div class="col-md-4">
                            <div class="step-section">
                                <h5 class="step-title">
                                    <i class="fas fa-wand-sparkles me-2"></i>
                                    Durante o Ritual
                                </h5>
                                <div id="ritualSteps" class="step-content">
                                    <div class="text-muted">Carregando...</div>
                                </div>
                            </div>
                        </div>

                        <!-- Pós-Ritual -->
                        <div class="col-md-4">
                            <div class="step-section">
                                <h5 class="step-title">
                                    <i class="fas fa-check-double me-2"></i>
                                    Pós-Ritual
                                </h5>
                                <div id="postRitualSteps" class="step-content">
                                    <div class="text-muted">Carregando...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botões de Ação -->
        <div class="col-12 text-center">
            <button id="saveRitual" class="btn btn-success btn-lg me-2">
                <i class="fas fa-save me-2"></i>
                Salvar Ritual
            </button>
            <button id="printRitual" class="btn btn-info btn-lg">
                <i class="fas fa-print me-2"></i>
                Imprimir
            </button>
        </div>
    </div>
</div>
