@extends('layouts.web')

@section('content')
    <x-header-page
        complement="Mapa de Chakras"
        title="Chakras"
        description="Explore seus centros de energia e descubra seu equilíbrio espiritual"
    />

    <div class="container py-4">
        <!-- Seção de Estatísticas -->
        <div class="mb-4 row">
            <div class="col-md-3">
                <div class="border-0 shadow-sm card stat-card">
                    <div class="text-center card-body">
                        <i class="mb-3 fas fa-brain fa-2x text-primary"></i>
                        <h3 class="mb-0">7</h3>
                        <p class="mb-0 text-muted">Chakras Principais</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="border-0 shadow-sm card stat-card">
                    <div class="text-center card-body">
                        <i class="mb-3 fas fa-clock fa-2x text-success"></i>
                        <h3 class="mb-0">21</h3>
                        <p class="mb-0 text-muted">Minutos de Meditação</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="border-0 shadow-sm card stat-card">
                    <div class="text-center card-body">
                        <i class="mb-3 fas fa-palette fa-2x text-warning"></i>
                        <h3 class="mb-0">7</h3>
                        <p class="mb-0 text-muted">Cores Vibracionais</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="border-0 shadow-sm card stat-card">
                    <div class="text-center card-body">
                        <i class="mb-3 fas fa-spa fa-2x text-info"></i>
                        <h3 class="mb-0">14</h3>
                        <p class="mb-0 text-muted">Práticas Recomendadas</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Coluna Principal -->
            <div class="mb-4 col-lg-8 mb-lg-0">
                <!-- Timer de Meditação -->
                <div class="mb-4">
                    <div class="border-0 shadow-sm card meditation-timer">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-hourglass-half me-2"></i>Timer de Meditação</h5>
                            <div class="mb-3 text-center timer-display">
                                <span class="display-4">21:00</span>
                            </div>
                            <div class="text-center timer-controls">
                                <button class="btn btn-primary me-2" id="startTimer">
                                    <i class="fas fa-play me-2"></i>Iniciar
                                </button>
                                <button class="btn btn-secondary me-2" id="pauseTimer">
                                    <i class="fas fa-pause me-2"></i>Pausar
                                </button>
                                <button class="btn btn-danger" id="resetTimer">
                                    <i class="fas fa-redo me-2"></i>Reiniciar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Chakras -->
                <div class="border-0 rounded-lg shadow-lg card chakras-card">
                    <div class="card-body">
                        <div class="chakras-container">
                            @foreach (['coroa','terceiro-olho','garganta','cardiaco','plexo-solar','sacral','raiz'] as $chakra)
                            <div class="chakra-item" data-chakra="{{ $chakra }}">
                                <div class="chakra-icon">
                                    @if($chakra=='coroa')
                                        <i class="fas fa-crown"></i>
                                    @elseif($chakra=='terceiro-olho')
                                        <i class="fas fa-eye"></i>
                                    @elseif($chakra=='garganta')
                                        <i class="fas fa-comment"></i>
                                    @elseif($chakra=='cardiaco')
                                        <i class="fas fa-heart"></i>
                                    @elseif($chakra=='plexo-solar')
                                        <i class="fas fa-sun"></i>
                                    @elseif($chakra=='sacral')
                                        <i class="fas fa-water"></i>
                                    @elseif($chakra=='raiz')
                                        <i class="fas fa-mountain"></i>
                                    @endif
                                </div>
                                <div class="chakra-info">
                                    <h5>Chakra {{ ucfirst($chakra) }}</h5>
                                    <div class="chakra-details">
                                        <p class="descricao"></p>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="caracteristicas">
                                                    <h6><i class="fas fa-star me-2"></i>Características</h6>
                                                    <ul></ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="desequilibrio">
                                                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Desequilíbrio</h6>
                                                    <ul></ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="equilibrio">
                                                    <h6><i class="fas fa-balance-scale me-2"></i>Equilíbrio</h6>
                                                    <ul></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 chakra-practices">
                                            <h6><i class="fas fa-spa me-2"></i>Práticas Recomendadas</h6>
                                            <div class="practices-grid"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna Lateral -->
            <div class="col-lg-4">
                <!-- Teste de Equilíbrio -->
                <div class="mb-4">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-balance-scale me-2"></i>Teste de Equilíbrio</h5>
                            <p class="card-text">Descubra o estado atual dos seus chakras com nosso teste rápido.</p>
                            <button class="btn btn-primary w-100" id="startTest">
                                <i class="fas fa-play-circle me-2"></i>Iniciar Teste
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Informações Gerais -->
                <div class="mb-4">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-info-circle me-2"></i>Sobre os Chakras</h5>
                            <p class="card-text">Os chakras são centros de energia vital que regulam diferentes aspectos do nosso ser físico, emocional e espiritual.</p>
                            <div class="chakra-tips">
                                <h6 class="mt-3"><i class="fas fa-lightbulb me-2"></i>Dicas para Equilíbrio</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Meditação diária</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Respiração consciente</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Yoga e exercícios físicos</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Alimentação equilibrada</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guia de Cores -->
                <div class="mb-4">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-palette me-2"></i>Cores e Elementos</h5>
                            <div class="color-guide">
                                <div class="color-item" style="background: linear-gradient(135deg, #8b5cf6, #6366f1);">
                                    <i class="fas fa-crown me-2"></i>
                                    <span>Coroa - Violeta</span>
                                </div>
                                <div class="color-item" style="background: linear-gradient(135deg, #6366f1, #4f46e5);">
                                    <i class="fas fa-eye me-2"></i>
                                    <span>Terceiro Olho - Índigo</span>
                                </div>
                                <div class="color-item" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                    <i class="fas fa-comment me-2"></i>
                                    <span>Garganta - Azul</span>
                                </div>
                                <div class="color-item" style="background: linear-gradient(135deg, #10b981, #059669);">
                                    <i class="fas fa-heart me-2"></i>
                                    <span>Cardíaco - Verde</span>
                                </div>
                                <div class="color-item" style="background: linear-gradient(135deg, #fbbf24, #f59e0b);">
                                    <i class="fas fa-sun me-2"></i>
                                    <span>Plexo Solar - Amarelo</span>
                                </div>
                                <div class="color-item" style="background: linear-gradient(135deg, #f97316, #ea580c);">
                                    <i class="fas fa-water me-2"></i>
                                    <span>Sacral - Laranja</span>
                                </div>
                                <div class="color-item" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                    <i class="fas fa-mountain me-2"></i>
                                    <span>Raiz - Vermelho</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Meditação Guiada -->
                <div>
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-om me-2"></i>Meditação Guiada</h5>
                            <p class="card-text">Experimente nossa meditação guiada para equilibrar seus chakras.</p>
                            <button class="btn btn-outline-primary w-100" id="startMeditation">
                                <i class="fas fa-play-circle me-2"></i>Iniciar Meditação
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal do Teste de Equilíbrio -->
    <div class="modal fade" id="testModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-balance-scale me-2"></i>Avaliação Completa dos Chakras
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="test-progress mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="chakra-name">Chakra Atual: <strong id="currentChakraName">Muladhara (Raiz)</strong></span>
                            <span class="question-counter">Questão <strong id="currentQuestionNumber">1</strong> de <strong id="totalQuestions">28</strong></span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>

                    <div id="testQuestion" class="mb-4"></div>
                    <div id="testOptions" class="options-grid"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Resultados -->
    <div class="modal fade" id="resultsModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-chart-pie me-2"></i>Seu Diagnóstico Energético
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="overview-section mb-4">
                        <h6 class="section-title">Visão Geral do Seu Equilíbrio Energético</h6>
                        <div class="chakra-chart-container">
                            <canvas id="chakraChart"></canvas>
                        </div>
                    </div>

                    <div id="detailedResults"></div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary me-2" onclick="downloadResults()">
                            <i class="fas fa-download me-2"></i>Baixar Resultados
                        </button>
                        <button class="btn btn-success" onclick="shareResults()">
                            <i class="fas fa-share-alt me-2"></i>Compartilhar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Ajustes Gerais */
    .chakras-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 1.5rem;
        overflow: hidden;
    }

    /* Lista de Chakras */
    .chakras-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        padding: 1rem;
    }

    .chakra-item {
        background: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        position: relative;
    }

    .chakra-item:hover {
        transform: translateX(10px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .chakra-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Cores para cada chakra */
    .chakra-item[data-chakra="coroa"] .chakra-icon { background: linear-gradient(135deg, #8b5cf6, #6366f1); }
    .chakra-item[data-chakra="terceiro-olho"] .chakra-icon { background: linear-gradient(135deg, #6366f1, #4f46e5); }
    .chakra-item[data-chakra="garganta"] .chakra-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .chakra-item[data-chakra="cardiaco"] .chakra-icon { background: linear-gradient(135deg, #10b981, #059669); }
    .chakra-item[data-chakra="plexo-solar"] .chakra-icon { background: linear-gradient(135deg, #fbbf24, #f59e0b); }
    .chakra-item[data-chakra="sacral"] .chakra-icon { background: linear-gradient(135deg, #f97316, #ea580c); }
    .chakra-item[data-chakra="raiz"] .chakra-icon { background: linear-gradient(135deg, #ef4444, #dc2626); }

    .chakra-info h5 {
        margin: 0;
        color: #2d3748;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .chakra-details {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e2e8f0;
    }

    .chakra-details h6 {
        color: #4a5568;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .chakra-details p {
        color: #4a5568;
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .chakra-details ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .chakra-details li {
        color: #4a5568;
        margin-bottom: 0.5rem;
        padding-left: 1.5rem;
        position: relative;
    }

    .chakra-details li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: var(--chakra-color, #ccc);
        font-weight: bold;
    }

    /* Práticas Recomendadas */
    .practices-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .practice-item {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1rem;
        transition: transform 0.2s ease;
    }

    .practice-item:hover {
        transform: translateY(-2px);
    }

    .practice-item h6 {
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .practice-item p {
        color: #4a5568;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .practice-item small {
        color: #718096;
    }

    /* Guia de Cores */
    .color-guide {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .color-item {
        padding: 0.75rem;
        border-radius: 0.5rem;
        color: #fff;
        font-weight: 500;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
    }

    /* Ajustes para dispositivos móveis */
    @media (max-width: 768px) {
        .chakra-item {
            flex-direction: column;
            text-align: center;
            padding: 1rem;
        }

        .chakra-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            margin: 0 auto;
        }

        .chakra-info h5 {
            font-size: 1.1rem;
        }
    }

    /* Novos estilos */
    .stat-card {
        transition: transform 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .meditation-timer {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .timer-display {
        font-family: 'Courier New', monospace;
        color: #2d3748;
    }

    .timer-controls button {
        min-width: 100px;
    }

    /* Estilos do Teste */
    .options-grid {
        display: grid;
        gap: 1rem;
    }

    .test-option {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .test-option:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }

    .test-option.selected {
        background: #cff4fc;
        border-color: #0dcaf0;
    }

    .test-option .option-number {
        width: 30px;
        height: 30px;
        background: #dee2e6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-weight: bold;
    }

    /* Estilos dos Resultados */
    .chakra-chart-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 1rem;
    }

    .chakra-result-card {
        border: none;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .chakra-result-card .card-header {
        border-radius: 1rem 1rem 0 0;
        padding: 1rem;
    }

    .chakra-status {
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-low { background: #ffe5e5; color: #dc3545; }
    .status-medium { background: #fff3cd; color: #ffc107; }
    .status-high { background: #d1e7dd; color: #198754; }

    .practice-card {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-top: 1rem;
    }

    .practice-card h6 {
        color: #0d6efd;
        margin-bottom: 0.5rem;
    }

    .practice-time {
        font-size: 0.875rem;
        color: #6c757d;
    }

    /* Ajustes na barra de progresso */
    .progress {
        background-color: #e9ecef;
        border-radius: 0.5rem;
    }

    .progress-bar {
        background: linear-gradient(135deg, #10b981, #059669);
        transition: width 0.3s ease;
    }
    </style>

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Dados dos chakras
    const chakras = {
        coroa: {
            nome: "Chakra Coroa",
            descricao: "O chakra coroa representa nossa conexão com o divino e a consciência universal.",
            caracteristicas: [
                "Espiritualidade elevada",
                "Sintonia com o universo",
                "Sabedoria superior",
                "Paz interior",
                "Iluminação"
            ],
            desequilibrio: [
                "Ceticismo excessivo",
                "Desconexão espiritual",
                "Dores de cabeça",
                "Confusão mental",
                "Isolamento"
            ],
            equilibrio: [
                "Meditação regular",
                "Práticas espirituais",
                "Conexão com a natureza",
                "Visualização de luz branca",
                "Práticas de gratidão"
            ],
            practices: [
                {
                    nome: "Meditação da Luz",
                    descricao: "Visualize uma luz branca descendo sobre você",
                    duracao: "10-15 minutos"
                },
                {
                    nome: "Conexão com a Natureza",
                    descricao: "Passe tempo ao ar livre, conectando-se com a terra",
                    duracao: "20-30 minutos"
                }
            ]
        },
        "terceiro-olho": {
            nome: "Chakra Terceiro Olho",
            descricao: "O chakra do terceiro olho governa nossa intuição e percepção extra-sensorial.",
            caracteristicas: [
                "Intuição forte",
                "Clarividência",
                "Imaginação fértil",
                "Sensibilidade",
                "Visão interior"
            ],
            desequilibrio: [
                "Dores de cabeça",
                "Problemas de visão",
                "Insônia",
                "Ansiedade",
                "Dificuldade de concentração"
            ],
            equilibrio: [
                "Meditação",
                "Visualização",
                "Práticas de intuição",
                "Contato com a natureza",
                "Exercícios de respiração"
            ],
            practices: [
                {
                    nome: "Visualização do Terceiro Olho",
                    descricao: "Foque sua atenção no ponto entre as sobrancelhas",
                    duracao: "5-10 minutos"
                },
                {
                    nome: "Exercício de Intuição",
                    descricao: "Pratique adivinhar pequenas coisas do dia a dia",
                    duracao: "15-20 minutos"
                }
            ]
        },
        garganta: {
            nome: "Chakra Garganta",
            descricao: "O chakra da garganta está relacionado à comunicação e expressão pessoal.",
            caracteristicas: [
                "Boa comunicação",
                "Expressão criativa",
                "Honestidade",
                "Confiança",
                "Autenticidade"
            ],
            desequilibrio: [
                "Dificuldade de expressão",
                "Problemas de voz",
                "Timidez",
                "Mentiras",
                "Tensão no pescoço"
            ],
            equilibrio: [
                "Canto",
                "Escrita",
                "Arte",
                "Respiração consciente",
                "Expressão criativa"
            ],
            practices: [
                {
                    nome: "Canto de Mantras",
                    descricao: "Cante o mantra OM em diferentes tons",
                    duracao: "10-15 minutos"
                },
                {
                    nome: "Escrita Expressiva",
                    descricao: "Escreva seus pensamentos sem censura",
                    duracao: "15-20 minutos"
                }
            ]
        },
        cardiaco: {
            nome: "Chakra Cardíaco",
            descricao: "O chakra cardíaco é o centro do amor, compaixão e conexão emocional.",
            caracteristicas: [
                "Amor incondicional",
                "Compaixão",
                "Empatia",
                "Harmonia",
                "Paz interior"
            ],
            desequilibrio: [
                "Dificuldade de amar",
                "Isolamento emocional",
                "Problemas cardíacos",
                "Raiva",
                "Mágoas"
            ],
            equilibrio: [
                "Práticas de amor",
                "Meditação do coração",
                "Yoga",
                "Terapia",
                "Conexão com pessoas"
            ],
            practices: [
                {
                    nome: "Meditação do Amor",
                    descricao: "Visualize amor e compaixão emanando do seu coração",
                    duracao: "10-15 minutos"
                },
                {
                    nome: "Prática de Gratidão",
                    descricao: "Liste 5 coisas pelas quais você é grato",
                    duracao: "5-10 minutos"
                }
            ]
        },
        "plexo-solar": {
            nome: "Chakra Plexo Solar",
            descricao: "O chakra do plexo solar está relacionado ao poder pessoal e autoconfiança.",
            caracteristicas: [
                "Autoconfiança",
                "Poder pessoal",
                "Determinação",
                "Vitalidade",
                "Força de vontade"
            ],
            desequilibrio: [
                "Baixa autoestima",
                "Insegurança",
                "Problemas digestivos",
                "Raiva",
                "Controle excessivo"
            ],
            equilibrio: [
                "Exercícios físicos",
                "Autoconhecimento",
                "Terapia",
                "Meditação",
                "Práticas de empoderamento"
            ],
            practices: [
                {
                    nome: "Exercícios de Poder",
                    descricao: "Pratique posturas de poder e afirmações positivas",
                    duracao: "10-15 minutos"
                },
                {
                    nome: "Meditação Solar",
                    descricao: "Visualize luz dourada no seu plexo solar",
                    duracao: "5-10 minutos"
                }
            ]
        },
        sacral: {
            nome: "Chakra Sacral",
            descricao: "O chakra sacral está relacionado à criatividade, prazer e emoções.",
            caracteristicas: [
                "Criatividade",
                "Prazer",
                "Emoções equilibradas",
                "Sexualidade saudável",
                "Alegria"
            ],
            desequilibrio: [
                "Problemas emocionais",
                "Baixa libido",
                "Criatividade bloqueada",
                "Dependência",
                "Problemas reprodutivos"
            ],
            equilibrio: [
                "Dança",
                "Arte",
                "Terapia",
                "Exercícios pélvicos",
                "Práticas de prazer"
            ],
            practices: [
                {
                    nome: "Dança Criativa",
                    descricao: "Dance livremente ao som de música que você gosta",
                    duracao: "15-20 minutos"
                },
                {
                    nome: "Arte Terapia",
                    descricao: "Pinte ou desenhe suas emoções",
                    duracao: "20-30 minutos"
                }
            ]
        },
        raiz: {
            nome: "Chakra Raiz",
            descricao: "O chakra raiz está relacionado à sobrevivência, segurança e estabilidade.",
            caracteristicas: [
                "Estabilidade",
                "Segurança",
                "Força",
                "Determinação",
                "Conectividade"
            ],
            desequilibrio: [
                "Insegurança",
                "Problemas financeiros",
                "Ansiedade",
                "Problemas de coluna",
                "Medo"
            ],
            equilibrio: [
                "Exercícios físicos",
                "Contato com a terra",
                "Meditação",
                "Terapia",
                "Práticas de enraizamento"
            ],
            practices: [
                {
                    nome: "Enraizamento",
                    descricao: "Visualize raízes saindo dos seus pés",
                    duracao: "10-15 minutos"
                },
                {
                    nome: "Caminhada Consciente",
                    descricao: "Caminhe descalço na natureza",
                    duracao: "20-30 minutos"
                }
            ]
        }
    };

    // Função para carregar as informações dos chakras na página
    function carregarChakras() {
        document.querySelectorAll('.chakra-item').forEach(item => {
            const chakraKey = item.dataset.chakra;
            if (chakras[chakraKey]) {
                const chakraData = chakras[chakraKey];

                // Atualizar descrição
                const descricao = item.querySelector('.descricao');
                if (descricao) descricao.textContent = chakraData.descricao;

                // Atualizar características
                const caracteristicas = item.querySelector('.caracteristicas ul');
                if (caracteristicas && chakraData.caracteristicas) {
                    caracteristicas.innerHTML = chakraData.caracteristicas
                        .map(c => `<li>${c}</li>`)
                        .join('');
                }

                // Atualizar desequilíbrio
                const desequilibrio = item.querySelector('.desequilibrio ul');
                if (desequilibrio && chakraData.desequilibrio) {
                    desequilibrio.innerHTML = chakraData.desequilibrio
                        .map(d => `<li>${d}</li>`)
                        .join('');
                }

                // Atualizar equilíbrio
                const equilibrio = item.querySelector('.equilibrio ul');
                if (equilibrio && chakraData.equilibrio) {
                    equilibrio.innerHTML = chakraData.equilibrio
                        .map(e => `<li>${e}</li>`)
                        .join('');
                }

                // Atualizar práticas
                const practicesGrid = item.querySelector('.practices-grid');
                if (practicesGrid && chakraData.practices) {
                    practicesGrid.innerHTML = chakraData.practices
                        .map(p => `
                            <div class="practice-item">
                                <h6>${p.nome}</h6>
                                <p>${p.descricao}</p>
                                <small>Duração: ${p.duracao}</small>
                            </div>
                        `)
                        .join('');
                }
            }
        });
    }

    // Timer de Meditação
    let timerInterval;
    let timeLeft = 21 * 60; // 21 minutos em segundos

    function startTimer() {
        if (!timerInterval) {
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerInterval = null;
                    alert('Meditação concluída!');
                }
            }, 1000);
        }
    }

    function pauseTimer() {
        clearInterval(timerInterval);
        timerInterval = null;
    }

    function resetTimer() {
        clearInterval(timerInterval);
        timerInterval = null;
        timeLeft = 21 * 60;
        updateTimerDisplay();
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        const display = document.querySelector('.timer-display span');
        if (display) {
            display.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }
    }

    function startMeditation() {
        alert('Meditação guiada será implementada em breve!');
    }

    // Perguntas do teste
    const testQuestions = {
        raiz: [
            {
                question: "Como você se sente em relação à sua segurança financeira?",
                options: [
                    { text: "Muito inseguro e preocupado constantemente", value: 1 },
                    { text: "Ocasionalmente preocupado", value: 2 },
                    { text: "Geralmente seguro e estável", value: 3 },
                    { text: "Completamente seguro e confiante", value: 4 }
                ]
            },
            {
                question: "Como está sua conexão com seu corpo físico?",
                options: [
                    { text: "Desconectado e desconfortável", value: 1 },
                    { text: "Às vezes presente, às vezes ausente", value: 2 },
                    { text: "Geralmente conectado e consciente", value: 3 },
                    { text: "Profundamente conectado e presente", value: 4 }
                ]
            },
            {
                question: "Como você se sente em relação à sua segurança pessoal?",
                options: [
                    { text: "Constantemente ansioso e inseguro", value: 1 },
                    { text: "Ocasionalmente preocupado", value: 2 },
                    { text: "Geralmente seguro", value: 3 },
                    { text: "Muito seguro e confiante", value: 4 }
                ]
            },
            {
                question: "Como está sua energia física e vitalidade?",
                options: [
                    { text: "Frequentemente cansado e sem energia", value: 1 },
                    { text: "Energia irregular", value: 2 },
                    { text: "Boa energia na maior parte do tempo", value: 3 },
                    { text: "Energia abundante e vital", value: 4 }
                ]
            }
        ],
        sacral: [
            {
                question: "Como você expressa sua criatividade?",
                options: [
                    { text: "Raramente me expresso criativamente", value: 1 },
                    { text: "Ocasionalmente tenho momentos criativos", value: 2 },
                    { text: "Frequentemente encontro formas de expressão", value: 3 },
                    { text: "Constantemente criativo e expressivo", value: 4 }
                ]
            },
            {
                question: "Como você lida com suas emoções?",
                options: [
                    { text: "Tenho dificuldade em sentir ou expressar", value: 1 },
                    { text: "Às vezes me sinto sobrecarregado", value: 2 },
                    { text: "Geralmente equilibrado", value: 3 },
                    { text: "Muito consciente e equilibrado", value: 4 }
                ]
            },
            {
                question: "Como está sua conexão com o prazer e alegria?",
                options: [
                    { text: "Raramente sinto prazer nas atividades", value: 1 },
                    { text: "Às vezes encontro momentos de alegria", value: 2 },
                    { text: "Frequentemente aproveito a vida", value: 3 },
                    { text: "Vivo com muita alegria e prazer", value: 4 }
                ]
            },
            {
                question: "Como você se relaciona com sua sexualidade?",
                options: [
                    { text: "Desconfortável ou bloqueado", value: 1 },
                    { text: "Com algumas inseguranças", value: 2 },
                    { text: "De forma saudável", value: 3 },
                    { text: "Com muita naturalidade e confiança", value: 4 }
                ]
            }
        ],
        "plexo-solar": [
            {
                question: "Como está sua autoestima?",
                options: [
                    { text: "Muito baixa, não confio em mim", value: 1 },
                    { text: "Varia dependendo da situação", value: 2 },
                    { text: "Geralmente boa", value: 3 },
                    { text: "Muito forte e consistente", value: 4 }
                ]
            },
            {
                question: "Como você lida com desafios?",
                options: [
                    { text: "Evito enfrentá-los", value: 1 },
                    { text: "Enfrento com hesitação", value: 2 },
                    { text: "Encaro com determinação", value: 3 },
                    { text: "Vejo como oportunidades", value: 4 }
                ]
            },
            {
                question: "Como está seu senso de poder pessoal?",
                options: [
                    { text: "Sinto-me sem poder ou controle", value: 1 },
                    { text: "Às vezes me sinto empoderado", value: 2 },
                    { text: "Geralmente confiante", value: 3 },
                    { text: "Muito empoderado e confiante", value: 4 }
                ]
            },
            {
                question: "Como você lida com críticas?",
                options: [
                    { text: "Me afetam muito negativamente", value: 1 },
                    { text: "Fico um pouco abalado", value: 2 },
                    { text: "Aceito construtivamente", value: 3 },
                    { text: "Vejo como oportunidade de crescimento", value: 4 }
                ]
            }
        ],
        cardiaco: [
            {
                question: "Como você expressa amor e compaixão?",
                options: [
                    { text: "Tenho dificuldade em expressar", value: 1 },
                    { text: "Expresso às vezes", value: 2 },
                    { text: "Expresso frequentemente", value: 3 },
                    { text: "Expresso naturalmente e sempre", value: 4 }
                ]
            },
            {
                question: "Como você se sente em relação ao perdão?",
                options: [
                    { text: "Tenho dificuldade em perdoar", value: 1 },
                    { text: "Perdoo com algum esforço", value: 2 },
                    { text: "Geralmente perdoo bem", value: 3 },
                    { text: "Perdoo facilmente", value: 4 }
                ]
            },
            {
                question: "Como está sua capacidade de receber amor?",
                options: [
                    { text: "Muito fechado para receber", value: 1 },
                    { text: "Às vezes me permito receber", value: 2 },
                    { text: "Geralmente aberto", value: 3 },
                    { text: "Totalmente aberto e receptivo", value: 4 }
                ]
            },
            {
                question: "Como você lida com relacionamentos?",
                options: [
                    { text: "Evito me aproximar das pessoas", value: 1 },
                    { text: "Mantenho algumas conexões", value: 2 },
                    { text: "Cultivo bons relacionamentos", value: 3 },
                    { text: "Conexões profundas e significativas", value: 4 }
                ]
            }
        ],
        garganta: [
            {
                question: "Como você se expressa verbalmente?",
                options: [
                    { text: "Tenho dificuldade em me expressar", value: 1 },
                    { text: "Me expresso com algum esforço", value: 2 },
                    { text: "Me comunico bem", value: 3 },
                    { text: "Me expresso com clareza e confiança", value: 4 }
                ]
            },
            {
                question: "Como você lida com sua verdade pessoal?",
                options: [
                    { text: "Tenho medo de ser verdadeiro", value: 1 },
                    { text: "Às vezes escondo o que penso", value: 2 },
                    { text: "Geralmente sou autêntico", value: 3 },
                    { text: "Sempre verdadeiro e autêntico", value: 4 }
                ]
            },
            {
                question: "Como você se sente ao falar em público?",
                options: [
                    { text: "Muito ansioso e evito", value: 1 },
                    { text: "Nervoso mas faço", value: 2 },
                    { text: "Relativamente confortável", value: 3 },
                    { text: "Muito confiante e natural", value: 4 }
                ]
            },
            {
                question: "Como você expressa sua criatividade verbal?",
                options: [
                    { text: "Raramente me expresso", value: 1 },
                    { text: "Às vezes encontro formas", value: 2 },
                    { text: "Frequentemente criativo", value: 3 },
                    { text: "Muito criativo e expressivo", value: 4 }
                ]
            }
        ],
        "terceiro-olho": [
            {
                question: "Como está sua intuição?",
                options: [
                    { text: "Raramente confio ou percebo", value: 1 },
                    { text: "Às vezes sinto sinais", value: 2 },
                    { text: "Frequentemente intuitivo", value: 3 },
                    { text: "Fortemente conectado", value: 4 }
                ]
            },
            {
                question: "Como é sua capacidade de visualização?",
                options: [
                    { text: "Tenho dificuldade em visualizar", value: 1 },
                    { text: "Visualizo com algum esforço", value: 2 },
                    { text: "Visualizo bem", value: 3 },
                    { text: "Visualizo com clareza e facilidade", value: 4 }
                ]
            },
            {
                question: "Como está sua clareza mental?",
                options: [
                    { text: "Frequentemente confuso", value: 1 },
                    { text: "Às vezes claro, às vezes confuso", value: 2 },
                    { text: "Geralmente claro", value: 3 },
                    { text: "Muito claro e focado", value: 4 }
                ]
            },
            {
                question: "Como você percebe sinais e símbolos?",
                options: [
                    { text: "Raramente percebo", value: 1 },
                    { text: "Às vezes noto", value: 2 },
                    { text: "Frequentemente percebo", value: 3 },
                    { text: "Muito perceptivo e consciente", value: 4 }
                ]
            }
        ],
        coroa: [
            {
                question: "Como está sua conexão espiritual?",
                options: [
                    { text: "Desconectado ou cético", value: 1 },
                    { text: "Busco compreender", value: 2 },
                    { text: "Conectado e aberto", value: 3 },
                    { text: "Profundamente conectado", value: 4 }
                ]
            },
            {
                question: "Como você lida com o propósito de vida?",
                options: [
                    { text: "Sem clareza ou direção", value: 1 },
                    { text: "Buscando entender", value: 2 },
                    { text: "Senso de propósito claro", value: 3 },
                    { text: "Totalmente alinhado", value: 4 }
                ]
            },
            {
                question: "Como é sua conexão com o divino?",
                options: [
                    { text: "Inexistente ou bloqueada", value: 1 },
                    { text: "Em desenvolvimento", value: 2 },
                    { text: "Boa conexão", value: 3 },
                    { text: "Profunda e constante", value: 4 }
                ]
            },
            {
                question: "Como você lida com a meditação?",
                options: [
                    { text: "Difícil me concentrar", value: 1 },
                    { text: "Pratico ocasionalmente", value: 2 },
                    { text: "Prática regular", value: 3 },
                    { text: "Prática profunda e constante", value: 4 }
                ]
            }
        ]
    };

    // Análises personalizadas para cada chakra
    const chakraAnalyses = {
        raiz: {
            low: "Seu chakra raiz está necessitando de atenção. Você pode estar experimentando insegurança em aspectos básicos da vida, como finanças, moradia ou segurança física. É importante trabalhar no seu enraizamento e conexão com a terra.",
            medium: "Seu chakra raiz está em desenvolvimento. Você está construindo bases mais sólidas em sua vida, mas ainda pode fortalecer sua sensação de segurança e estabilidade.",
            high: "Seu chakra raiz está bem equilibrado. Você possui uma forte conexão com sua base, sentindo-se seguro e estável em sua vida. Continue mantendo essa conexão através de práticas regulares."
        },
        sacral: {
            low: "Seu chakra sacral precisa de atenção. Você pode estar experimentando bloqueios em sua criatividade, expressão emocional ou prazer. É importante trabalhar na liberação de emoções reprimidas.",
            medium: "Seu chakra sacral está em desenvolvimento. Você está começando a se abrir mais para suas emoções e criatividade, mas ainda pode aprofundar essa conexão.",
            high: "Seu chakra sacral está bem equilibrado. Você possui uma boa conexão com suas emoções, criatividade e prazer. Continue explorando e expressando sua energia criativa."
        },
        "plexo-solar": {
            low: "Seu chakra do plexo solar necessita de atenção. Você pode estar experimentando baixa autoestima, falta de confiança ou problemas com poder pessoal. É importante trabalhar seu empoderamento.",
            medium: "Seu chakra do plexo solar está em desenvolvimento. Você está construindo sua confiança e poder pessoal, mas ainda pode fortalecer sua autoestima.",
            high: "Seu chakra do plexo solar está bem equilibrado. Você possui uma forte sensação de poder pessoal e autoestima. Continue cultivando sua confiança e determinação."
        },
        cardiaco: {
            low: "Seu chakra cardíaco precisa de atenção. Você pode estar experimentando dificuldades em dar e receber amor, ou em manter relacionamentos saudáveis. É importante trabalhar na abertura do coração.",
            medium: "Seu chakra cardíaco está em desenvolvimento. Você está se abrindo mais para o amor e compaixão, mas ainda pode aprofundar suas conexões emocionais.",
            high: "Seu chakra cardíaco está bem equilibrado. Você possui uma forte capacidade de amar e se conectar com os outros. Continue cultivando amor e compaixão."
        },
        garganta: {
            low: "Seu chakra da garganta necessita de atenção. Você pode estar tendo dificuldades em se expressar ou em falar sua verdade. É importante trabalhar na comunicação autêntica.",
            medium: "Seu chakra da garganta está em desenvolvimento. Você está aprendendo a se expressar melhor, mas ainda pode fortalecer sua voz e autenticidade.",
            high: "Seu chakra da garganta está bem equilibrado. Você possui uma forte capacidade de expressão e comunicação. Continue compartilhando sua verdade com clareza."
        },
        "terceiro-olho": {
            low: "Seu chakra do terceiro olho precisa de atenção. Você pode estar experimentando falta de clareza mental ou bloqueios em sua intuição. É importante trabalhar no desenvolvimento da percepção.",
            medium: "Seu chakra do terceiro olho está em desenvolvimento. Sua intuição está se desenvolvendo, mas você ainda pode aprofundar sua clareza e percepção.",
            high: "Seu chakra do terceiro olho está bem equilibrado. Você possui uma forte conexão com sua intuição e clareza mental. Continue desenvolvendo sua visão interior."
        },
        coroa: {
            low: "Seu chakra da coroa necessita de atenção. Você pode estar se sentindo desconectado espiritualmente ou sem propósito. É importante trabalhar na sua conexão espiritual.",
            medium: "Seu chakra da coroa está em desenvolvimento. Você está expandindo sua consciência espiritual, mas ainda pode aprofundar sua conexão com o divino.",
            high: "Seu chakra da coroa está bem equilibrado. Você possui uma forte conexão espiritual e senso de propósito. Continue cultivando sua consciência superior."
        }
    };

    // Práticas recomendadas para cada chakra e nível
    const chakraPractices = {
        raiz: {
            low: [
                {
                    name: "Meditação de Enraizamento",
                    description: "Visualize raízes saindo de seus pés e conectando-se profundamente com a Terra.",
                    duration: "15 minutos diários"
                },
                {
                    name: "Caminhada na Natureza",
                    description: "Caminhe descalço em contato direto com a terra ou grama.",
                    duration: "30 minutos, 3x por semana"
                },
                {
                    name: "Yoga para Enraizamento",
                    description: "Pratique posturas como Montanha, Guerreiro I e Cadeira.",
                    duration: "20 minutos diários"
                }
            ],
            medium: [
                {
                    name: "Meditação com Cristais",
                    description: "Medite com cristais vermelhos ou pretos como Jaspe Vermelho ou Turmalina Negra.",
                    duration: "10 minutos diários"
                },
                {
                    name: "Dança Livre",
                    description: "Dance músicas com batidas fortes para conectar-se com seu corpo.",
                    duration: "15 minutos diários"
                }
            ],
            high: [
                {
                    name: "Prática de Gratidão",
                    description: "Mantenha um diário de gratidão focado em aspectos materiais da vida.",
                    duration: "5 minutos diários"
                },
                {
                    name: "Jardinagem",
                    description: "Cultive plantas e conecte-se com a terra.",
                    duration: "Semanalmente"
                }
            ]
        },
        sacral: {
            low: [
                {
                    name: "Dança Livre",
                    description: "Dance de forma espontânea, permitindo que seu corpo se expresse livremente.",
                    duration: "20 minutos diários"
                },
                {
                    name: "Arte Expressiva",
                    description: "Desenhe ou pinte sem julgamentos, usando cores vibrantes.",
                    duration: "30 minutos, 3x por semana"
                }
            ],
            medium: [
                {
                    name: "Meditação com Água",
                    description: "Medite próximo à água ou visualize água fluindo.",
                    duration: "15 minutos diários"
                },
                {
                    name: "Exercícios de Respiração",
                    description: "Pratique respiração profunda focando no baixo ventre.",
                    duration: "10 minutos, 2x ao dia"
                }
            ],
            high: [
                {
                    name: "Yoga Criativo",
                    description: "Pratique sequências de yoga fluidas e criativas.",
                    duration: "30 minutos diários"
                },
                {
                    name: "Diário Emocional",
                    description: "Escreva sobre suas emoções e sentimentos.",
                    duration: "15 minutos diários"
                }
            ]
        },
        "plexo-solar": {
            low: [
                {
                    name: "Exercícios de Poder",
                    description: "Pratique posturas de poder e afirmações positivas.",
                    duration: "10 minutos, 3x ao dia"
                },
                {
                    name: "Meditação Solar",
                    description: "Medite ao sol da manhã, absorvendo sua energia.",
                    duration: "15 minutos diários"
                }
            ],
            medium: [
                {
                    name: "Pranayama do Fogo",
                    description: "Pratique respiração Kapalabhati para aumentar energia.",
                    duration: "5 minutos, 2x ao dia"
                },
                {
                    name: "Visualização de Luz Dourada",
                    description: "Visualize luz dourada preenchendo seu plexo solar.",
                    duration: "10 minutos diários"
                }
            ],
            high: [
                {
                    name: "Prática de Liderança",
                    description: "Assuma pequenos projetos ou lidere atividades.",
                    duration: "Semanalmente"
                },
                {
                    name: "Exercícios Físicos",
                    description: "Pratique exercícios que fortaleçam o core.",
                    duration: "30 minutos diários"
                }
            ]
        },
        cardiaco: {
            low: [
                {
                    name: "Meditação do Amor",
                    description: "Pratique Metta (meditação do amor universal).",
                    duration: "20 minutos diários"
                },
                {
                    name: "Diário da Gratidão",
                    description: "Escreva 3 coisas pelas quais você é grato.",
                    duration: "5 minutos diários"
                }
            ],
            medium: [
                {
                    name: "Yoga do Coração",
                    description: "Pratique posturas de abertura do peito.",
                    duration: "20 minutos diários"
                },
                {
                    name: "Perdão Consciente",
                    description: "Pratique exercícios de perdão e liberação.",
                    duration: "15 minutos diários"
                }
            ],
            high: [
                {
                    name: "Serviço Voluntário",
                    description: "Dedique tempo para ajudar outros.",
                    duration: "Semanalmente"
                },
                {
                    name: "Círculo de Amor",
                    description: "Organize encontros para compartilhar amor e gratidão.",
                    duration: "Mensalmente"
                }
            ]
        },
        garganta: {
            low: [
                {
                    name: "Canto de Mantras",
                    description: "Pratique o canto de mantras simples como OM.",
                    duration: "10 minutos diários"
                },
                {
                    name: "Exercícios Vocais",
                    description: "Faça exercícios de aquecimento vocal.",
                    duration: "5 minutos, 3x ao dia"
                }
            ],
            medium: [
                {
                    name: "Escrita Livre",
                    description: "Escreva seus pensamentos sem censura.",
                    duration: "15 minutos diários"
                },
                {
                    name: "Comunicação Consciente",
                    description: "Pratique falar sua verdade com compaixão.",
                    duration: "Durante o dia"
                }
            ],
            high: [
                {
                    name: "Expressão Criativa",
                    description: "Compartilhe suas ideias através da arte ou palavras.",
                    duration: "30 minutos diários"
                },
                {
                    name: "Canto em Grupo",
                    description: "Participe de círculos de canto ou coral.",
                    duration: "Semanalmente"
                }
            ]
        },
        "terceiro-olho": {
            low: [
                {
                    name: "Meditação Guiada",
                    description: "Pratique visualizações guiadas para desenvolver intuição.",
                    duration: "15 minutos diários"
                },
                {
                    name: "Exercícios de Visualização",
                    description: "Visualize cores, formas e símbolos.",
                    duration: "10 minutos, 2x ao dia"
                }
            ],
            medium: [
                {
                    name: "Contemplação",
                    description: "Observe uma vela ou objeto com foco total.",
                    duration: "10 minutos diários"
                },
                {
                    name: "Diário dos Sonhos",
                    description: "Registre e analise seus sonhos.",
                    duration: "10 minutos pela manhã"
                }
            ],
            high: [
                {
                    name: "Meditação Profunda",
                    description: "Pratique meditação silenciosa focando no terceiro olho.",
                    duration: "30 minutos diários"
                },
                {
                    name: "Desenvolvimento Intuitivo",
                    description: "Pratique exercícios de percepção extra-sensorial.",
                    duration: "20 minutos diários"
                }
            ]
        },
        coroa: {
            low: [
                {
                    name: "Meditação Silenciosa",
                    description: "Pratique momentos de silêncio e contemplação.",
                    duration: "15 minutos diários"
                },
                {
                    name: "Conexão com o Divino",
                    description: "Dedique tempo para oração ou prática espiritual.",
                    duration: "10 minutos, 2x ao dia"
                }
            ],
            medium: [
                {
                    name: "Estudo Espiritual",
                    description: "Leia textos sagrados ou espirituais.",
                    duration: "20 minutos diários"
                },
                {
                    name: "Meditação com Cristais",
                    description: "Medite com ametista ou quartzo claro.",
                    duration: "15 minutos diários"
                }
            ],
            high: [
                {
                    name: "Retiro Espiritual",
                    description: "Dedique tempo para práticas espirituais intensivas.",
                    duration: "Mensalmente"
                },
                {
                    name: "Mentoria Espiritual",
                    description: "Compartilhe sabedoria e oriente outros.",
                    duration: "Semanalmente"
                }
            ]
        }
    };

    let currentChakra = 'raiz';
    let currentQuestionIndex = 0;
    let results = {
        raiz: 0,
        sacral: 0,
        "plexo-solar": 0,
        cardiaco: 0,
        garganta: 0,
        "terceiro-olho": 0,
        coroa: 0
    };

    function startTest() {
        try {
            currentChakra = 'raiz';
            currentQuestionIndex = 0;
            results = {
                raiz: 0,
                sacral: 0,
                "plexo-solar": 0,
                cardiaco: 0,
                garganta: 0,
                "terceiro-olho": 0,
                coroa: 0
            };

            const testModal = document.getElementById('testModal');
            if (testModal) {
                showQuestion();
                new bootstrap.Modal(testModal).show();
            } else {
                throw new Error('Modal do teste não encontrado');
            }
        } catch (error) {
            console.error('Erro ao iniciar o teste:', error);
            alert('Ocorreu um erro ao iniciar o teste. Por favor, recarregue a página e tente novamente.');
        }
    }

    function showQuestion() {
        try {
            if (!currentChakra || !testQuestions[currentChakra]) {
                throw new Error('Chakra atual inválido');
            }

            const question = testQuestions[currentChakra][currentQuestionIndex];
            if (!question) {
                throw new Error('Questão não encontrada');
            }

            const chakraNameElement = document.getElementById('currentChakraName');
            const questionNumberElement = document.getElementById('currentQuestionNumber');
            const questionElement = document.getElementById('testQuestion');
            const optionsElement = document.getElementById('testOptions');

            if (!chakraNameElement || !questionNumberElement || !questionElement || !optionsElement) {
                throw new Error('Elementos do teste não encontrados');
            }

            // Atualizar nome do chakra
            chakraNameElement.textContent = chakras[currentChakra].nome;

            // Atualizar número da questão
            const questionNumber = (currentQuestionIndex + 1) + (Object.keys(results).indexOf(currentChakra) * 4);
            const totalQuestions = Object.keys(testQuestions).length * 4;
            questionNumberElement.textContent = `${questionNumber} de ${totalQuestions}`;

            // Atualizar questão
            questionElement.innerHTML = `
                <h6 class="question-text">${question.question}</h6>
            `;

            // Atualizar opções
            const optionsHtml = question.options.map((option, index) => `
                <div class="test-option" data-value="${option.value}">
                    <span class="option-number">${index + 1}</span>
                    <span class="option-text">${option.text}</span>
                </div>
            `).join('');

            optionsElement.innerHTML = optionsHtml;

            // Adicionar event listeners às opções
            document.querySelectorAll('.test-option').forEach(option => {
                option.addEventListener('click', () => {
                    const value = parseInt(option.dataset.value);
                    if (!isNaN(value)) {
                        selectOption(value);
                    }
                });
            });

            updateProgress();
        } catch (error) {
            console.error('Erro ao mostrar questão:', error);
            alert('Ocorreu um erro ao mostrar a questão. Por favor, tente novamente.');
        }
    }

    function selectOption(value) {
        try {
            if (!currentChakra || !results.hasOwnProperty(currentChakra)) {
                throw new Error('Chakra atual inválido');
            }

            if (isNaN(value) || value < 1 || value > 4) {
                throw new Error('Valor de resposta inválido');
            }

            // Adicionar valor à pontuação do chakra atual
            results[currentChakra] += value;

            // Verificar se há mais questões para o chakra atual
            if (currentQuestionIndex < testQuestions[currentChakra].length - 1) {
                currentQuestionIndex++;
            } else {
                // Verificar se há mais chakras para avaliar
                const chakraKeys = Object.keys(results);
                const currentChakraIndex = chakraKeys.indexOf(currentChakra);

                if (currentChakraIndex < chakraKeys.length - 1) {
                    currentChakra = chakraKeys[currentChakraIndex + 1];
                    currentQuestionIndex = 0;
                } else {
                    // Teste completo, mostrar resultados
                    showResults();
                    return;
                }
            }

            showQuestion();
        } catch (error) {
            console.error('Erro ao selecionar opção:', error);
            alert('Ocorreu um erro ao processar sua resposta. Por favor, tente novamente.');
        }
    }

    function updateProgress() {
        try {
            const progressBar = document.querySelector('.progress-bar');
            if (!progressBar) {
                throw new Error('Barra de progresso não encontrada');
            }

            const totalQuestions = Object.values(testQuestions).reduce((acc, curr) => acc + curr.length, 0);
            const answeredQuestions = Object.keys(results).reduce((acc, chakra, index) => {
                if (chakra === currentChakra) {
                    return acc + currentQuestionIndex;
                }
                return acc + (index < Object.keys(results).indexOf(currentChakra) ? testQuestions[chakra].length : 0);
            }, 0);

            const progress = (answeredQuestions / totalQuestions) * 100;
            progressBar.style.width = `${progress}%`;
            progressBar.setAttribute('aria-valuenow', progress);
        } catch (error) {
            console.error('Erro ao atualizar progresso:', error);
        }
    }

    function getChakraAnalysis(chakra, percentage) {
        const level = percentage < 50 ? 'low' : percentage < 75 ? 'medium' : 'high';
        return chakraAnalyses[chakra][level];
    }

    function getRecommendedPractices(chakra, percentage) {
        const level = percentage < 50 ? 'low' : percentage < 75 ? 'medium' : 'high';
        return chakraPractices[chakra]?.[level] || [];
    }

    function showResults() {
        const maxScore = 16; // 4 perguntas * pontuação máxima de 4

        try {
            // Criar gráfico
            const ctx = document.getElementById('chakraChart');
            if (ctx) {
                const chartData = {
                    labels: Object.values(chakras).map(c => c.nome),
                    datasets: [{
                        label: 'Seu Equilíbrio Energético',
                        data: Object.values(results).map(v => (v / maxScore) * 100),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                };

                const chartOptions = {
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 20
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                };

                if (window.chakraChart instanceof Chart) {
                    window.chakraChart.destroy();
                }

                window.chakraChart = new Chart(ctx, {
                    type: 'radar',
                    data: chartData,
                    options: chartOptions
                });
            }

            // Gerar resultados detalhados
            const detailedResults = document.getElementById('detailedResults');
            if (detailedResults) {
                const resultsHtml = Object.entries(results).map(([chakra, score]) => {
                    const percentage = (score / maxScore) * 100;
                    let status, statusClass;

                    if (percentage < 50) {
                        status = "Necessita Atenção";
                        statusClass = "status-low";
                    } else if (percentage < 75) {
                        status = "Em Desenvolvimento";
                        statusClass = "status-medium";
                    } else {
                        status = "Bem Equilibrado";
                        statusClass = "status-high";
                    }

                    const analysis = getChakraAnalysis(chakra, percentage);
                    const practices = getRecommendedPractices(chakra, percentage);

                    return `
                        <div class="chakra-result-card card">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">${chakras[chakra].nome}</h6>
                                    <span class="chakra-status ${statusClass}">${status}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="progress mb-3" style="height: 10px;">
                                    <div class="progress-bar bg-info" style="width: ${percentage}%"></div>
                                </div>

                                <p class="mb-3">${analysis}</p>

                                <h6 class="mb-2"><i class="fas fa-list-ul me-2"></i>Práticas Recomendadas:</h6>
                                ${practices.map(practice => `
                                    <div class="practice-card">
                                        <h6>${practice.name}</h6>
                                        <p class="mb-1">${practice.description}</p>
                                        <span class="practice-time">
                                            <i class="far fa-clock me-1"></i>${practice.duration}
                                        </span>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                }).join('');

                detailedResults.innerHTML = resultsHtml;
            }

            // Fechar modal do teste e abrir modal de resultados
            const testModal = document.getElementById('testModal');
            const resultsModal = document.getElementById('resultsModal');

            if (testModal && resultsModal) {
                const bsTestModal = bootstrap.Modal.getInstance(testModal);
                if (bsTestModal) {
                    bsTestModal.hide();
                }

                const bsResultsModal = new bootstrap.Modal(resultsModal);
                bsResultsModal.show();
            }
        } catch (error) {
            console.error('Erro ao mostrar resultados:', error);
            alert('Ocorreu um erro ao mostrar os resultados. Por favor, tente novamente.');
        }
    }

    // Função auxiliar para formatar o texto do status
    function getStatusText(percentage) {
        if (percentage < 50) return "Necessita Atenção";
        if (percentage < 75) return "Em Desenvolvimento";
        return "Bem Equilibrado";
    }

    // Função auxiliar para obter a classe CSS do status
    function getStatusClass(percentage) {
        if (percentage < 50) return "status-low";
        if (percentage < 75) return "status-medium";
        return "status-high";
    }

    function downloadResults() {
        // Implementar download do PDF com resultados
        alert("Download dos resultados em PDF será implementado em breve!");
    }

    function shareResults() {
        // Implementar compartilhamento
        alert("Compartilhamento de resultados será implementado em breve!");
    }

    // Inicialização
    document.addEventListener('DOMContentLoaded', function() {
        // Carregar informações dos chakras
        carregarChakras();

        // Adicionar event listeners
        document.getElementById('startTest')?.addEventListener('click', startTest);
        document.getElementById('startTimer')?.addEventListener('click', startTimer);
        document.getElementById('pauseTimer')?.addEventListener('click', pauseTimer);
        document.getElementById('resetTimer')?.addEventListener('click', resetTimer);
        document.getElementById('startMeditation')?.addEventListener('click', startMeditation);
    });
    </script>
@endsection
@endsection
