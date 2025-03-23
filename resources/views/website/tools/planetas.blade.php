@extends('layouts.web')

@section('content')
<!-- Hero Section -->
<section class="py-4 overflow-hidden position-relative">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="mb-3">
                    <span class="px-3 py-2 badge bg-success bg-opacity-10 text-success">
                        Guia Místico
                    </span>
                </div>
                <h1 class="mb-3 display-4 fw-bold font-cinzel">
                    {{ $seo['title'] }}
                </h1>
                <p class="mb-0 lead text-muted">
                    {{ $seo['description'] }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Tabela de Planetas -->
<section class="mb-5">
    <div class="border-0 shadow-sm card">
        <div class="p-4 card-body">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h2 class="mb-0 h4">✨ Correspondências Planetárias</h2>
                <div class="btn-group">
                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="fas fa-print"></i>
                    </button>
                    <button class="btn btn-outline-primary" onclick="downloadTable()">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
            <thead>
                <tr>
                            <th>Símbolo</th>
                            <th>Planeta (Dia)</th>
                            <th>Cores</th>
                            <th>Ervas</th>
                            <th>Pedras</th>
                            <th>Ritual Sugerido</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                            <td class="text-center" style="font-size: 2em;">☉</td>
                            <td><strong>Sol (Domingo)</strong></td>
                            <td>Dourado, laranja, amarelo</td>
                            <td>Angélica, açafrão, alecrim, calêndula, canela, girassol, lavanda, laranjeira, sálvia</td>
                            <td>Citrino, topázio, pedras amarelas ou laranjas</td>
                            <td>Ao amanhecer de um domingo, acenda uma vela dourada ou amarela. Concentre-se em absorver a energia solar para revitalizar seu espírito e atrair sucesso em seus empreendimentos.</td>
                </tr>
                <tr>
                            <td class="text-center" style="font-size: 2em;">☽</td>
                            <td><strong>Lua (Segunda)</strong></td>
                            <td>Branco, prata, tons perolados</td>
                            <td>Alfazema, dama-da-noite, tília, papoula, rosa branca</td>
                            <td>Pedra da lua, pérola, quartzo branco</td>
                            <td>À noite, sob a luz da lua, acenda um incenso de jasmim e medite, buscando aprofundar sua intuição e promover sonhos reveladores.</td>
                </tr>
                <tr>
                            <td class="text-center" style="font-size: 2em;">♂</td>
                            <td><strong>Marte (Terça)</strong></td>
                            <td>Vermelho</td>
                            <td>Absinto, alho, artemísia, beladona, cardo, hortelã, pimenta, urtiga</td>
                            <td>Granada, hematita, rubi</td>
                            <td>Crie um amuleto de proteção utilizando uma pedra de hematita. Segure a pedra em suas mãos e visualize uma energia vermelha brilhante emanando dela.</td>
                </tr>
                <tr>
                            <td class="text-center" style="font-size: 2em;">☿</td>
                            <td><strong>Mercúrio (Quarta)</strong></td>
                            <td>Púrpura</td>
                            <td>Anis, camomila, margarida, rosa amarela, madressilva, acácia, trevo, sabugueiro</td>
                            <td>Esmeralda, ágata</td>
                            <td>Em uma quarta-feira, dedique tempo para escrever em um diário ou iniciar um novo curso de estudo. Acenda uma vela púrpura e peça a Mercúrio clareza mental.</td>
                </tr>
                <tr>
                            <td class="text-center" style="font-size: 2em;">♃</td>
                            <td><strong>Júpiter (Quinta)</strong></td>
                            <td>Azul, roxo</td>
                            <td>Cedro, espinheiro, freixo, peônia, sorveira, violeta, morangueiro, sálvia</td>
                            <td>Ametista, turquesa</td>
                            <td>Em uma quinta-feira, desenhe o símbolo de Júpiter em um pedaço de papel azul. Coloque uma ametista sobre o símbolo e medite sobre seus objetivos.</td>
                </tr>
                <tr>
                            <td class="text-center" style="font-size: 2em;">♀</td>
                            <td><strong>Vênus (Sexta)</strong></td>
                            <td>Verde</td>
                            <td>Rosa, rosa cor-de-rosa, macieira, malva, íris, coentro, verbena, manjericão, melissa, lilás, lavanda</td>
                            <td>Quartzo rosa, esmeralda</td>
                            <td>Em uma sexta-feira, acenda uma vela verde e tome um banho de ervas com pétalas de rosa. Visualize a energia amorosa de Vênus envolvendo você.</td>
                </tr>
                <tr>
                            <td class="text-center" style="font-size: 2em;">♄</td>
                            <td><strong>Saturno (Sábado)</strong></td>
                            <td>Preto, cinza, marrom</td>
                            <td>Aloe, cicuta, cipreste, cominho, funcho, mandrágora, musgo, sálvia, visco</td>
                            <td>Ônix, obsidiana, turmalina negra</td>
                            <td>Em um sábado, acenda uma vela preta e medite sobre a importância da disciplina e da estrutura em sua vida.</td>
                </tr>
            </tbody>
        </table>
            </div>
        </div>
    </div>
</section>

<!-- Horários Planetários -->
<section class="mb-5">
    <div class="border-0 shadow-sm card">
        <div class="p-4 card-body">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="mb-3 h4">🌍 Horários Planetários</h2>
                    <p class="mb-0">
            Além dos dias da semana, os planetas também possuem horários específicos em que suas energias estão mais
            intensas e favoráveis para práticas mágicas. Ou seja, se você deseja realizar um ritual relacionado a Marte,
                        e não é o dia de Marte, você pode esperar pelo horário de Marte para potencializar seus resultados.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('website.hora-planetaria') }}" class="btn btn-primary">
                        <i class="fas fa-clock me-2"></i>Ver Horários
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Guia de Trabalhos por Planeta -->
<section class="mb-5">
    <div class="border-0 shadow-sm card">
        <div class="p-4 card-body">
            <h2 class="mb-4 h4">📚 Guia de Trabalhos por Planeta</h2>
            <div class="row g-4">
                <!-- Sol -->
                <div class="col-md-6 col-lg-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 card-body">
                            <div class="mb-3 text-center">
                                <span class="display-4">☀️</span>
                            </div>
                            <h3 class="mb-3 text-center h5">Sol</h3>
                            <ul class="mb-0 list-unstyled">
                                <li class="mb-2"><strong>Dia:</strong> Domingo</li>
                                <li class="mb-2"><strong>Elemento:</strong> Fogo</li>
                                <li class="mb-2"><strong>Regência:</strong> Poder, autoridade, sucesso</li>
                                <li class="mb-2"><strong>Traços:</strong> Liderança, confiança, vitalidade</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Lua -->
                <div class="col-md-6 col-lg-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 card-body">
                            <div class="mb-3 text-center">
                                <span class="display-4">🌙</span>
                            </div>
                            <h3 class="mb-3 text-center h5">Lua</h3>
                            <ul class="mb-0 list-unstyled">
                                <li class="mb-2"><strong>Dia:</strong> Segunda-feira</li>
                                <li class="mb-2"><strong>Elemento:</strong> Água</li>
                                <li class="mb-2"><strong>Regência:</strong> Intuição, emoções, sonhos</li>
                                <li class="mb-2"><strong>Traços:</strong> Sensibilidade, mistério, fertilidade</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Marte -->
                <div class="col-md-6 col-lg-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 card-body">
                            <div class="mb-3 text-center">
                                <span class="display-4">🔥</span>
                            </div>
                            <h3 class="mb-3 text-center h5">Marte</h3>
                            <ul class="mb-0 list-unstyled">
                                <li class="mb-2"><strong>Dia:</strong> Terça-feira</li>
                                <li class="mb-2"><strong>Elemento:</strong> Fogo</li>
                                <li class="mb-2"><strong>Regência:</strong> Coragem, força, ação</li>
                                <li class="mb-2"><strong>Traços:</strong> Energia, proteção, conquista</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Mercúrio -->
                <div class="col-md-6 col-lg-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 card-body">
                            <div class="mb-3 text-center">
                                <span class="display-4">💫</span>
                            </div>
                            <h3 class="mb-3 text-center h5">Mercúrio</h3>
                            <ul class="mb-0 list-unstyled">
                                <li class="mb-2"><strong>Dia:</strong> Quarta-feira</li>
                                <li class="mb-2"><strong>Elemento:</strong> Ar</li>
                                <li class="mb-2"><strong>Regência:</strong> Comunicação, escrita, viagens</li>
                                <li class="mb-2"><strong>Traços:</strong> Inteligência, adaptabilidade, comércio</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Júpiter -->
                <div class="col-md-6 col-lg-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 card-body">
                            <div class="mb-3 text-center">
                                <span class="display-4">🌟</span>
                            </div>
                            <h3 class="mb-3 text-center h5">Júpiter</h3>
                            <ul class="mb-0 list-unstyled">
                                <li class="mb-2"><strong>Dia:</strong> Quinta-feira</li>
                                <li class="mb-2"><strong>Elemento:</strong> Fogo</li>
                                <li class="mb-2"><strong>Regência:</strong> Abundância, prosperidade, sorte</li>
                                <li class="mb-2"><strong>Traços:</strong> Expansão, sabedoria, crescimento</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Vênus -->
                <div class="col-md-6 col-lg-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 card-body">
                            <div class="mb-3 text-center">
                                <span class="display-4">💝</span>
                            </div>
                            <h3 class="mb-3 text-center h5">Vênus</h3>
                            <ul class="mb-0 list-unstyled">
                                <li class="mb-2"><strong>Dia:</strong> Sexta-feira</li>
                                <li class="mb-2"><strong>Elemento:</strong> Terra</li>
                                <li class="mb-2"><strong>Regência:</strong> Amor, beleza, harmonia</li>
                                <li class="mb-2"><strong>Traços:</strong> Arte, relacionamentos, prazer</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Saturno -->
                <div class="col-md-6 col-lg-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="p-4 card-body">
                            <div class="mb-3 text-center">
                                <span class="display-4">🪐</span>
                            </div>
                            <h3 class="mb-3 text-center h5">Saturno</h3>
                            <ul class="mb-0 list-unstyled">
                                <li class="mb-2"><strong>Dia:</strong> Sábado</li>
                                <li class="mb-2"><strong>Elemento:</strong> Terra</li>
                                <li class="mb-2"><strong>Regência:</strong> Proteção, banimento, limpeza</li>
                                <li class="mb-2"><strong>Traços:</strong> Disciplina, transformação, estrutura</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        <style>
    .table {
        margin-bottom: 0;
    }
    th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    td {
        vertical-align: middle;
        padding: 0.75rem;
    }
    @media print {
        body * {
            visibility: hidden;
        }
        .table, .table * {
            visibility: visible;
        }
        .table {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
            }
        </style>
    @stop

    @section('js')
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    // Função para baixar a tabela como imagem
    function downloadTable() {
        const table = document.querySelector('.table');

        html2canvas(table).then(function(canvas) {
            const link = document.createElement('a');
            link.download = `correspondencias-planetarias-${new Date().toLocaleDateString('pt-BR')}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    }
</script>
    @stop
