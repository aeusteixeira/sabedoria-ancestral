@extends('layouts.web')
@section('content')
<!-- Hero Section -->
<section class="py-4 overflow-hidden position-relative">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="mb-3">
                    <span class="px-3 py-2 badge bg-success bg-opacity-10 text-success">
                        Ferramenta Mística
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

<!-- Calendário e Informações -->
<section class="mb-5">
    <div class="row g-4">
        <!-- Calendário -->
        <div class="col-lg-8">
            <div class="border-0 shadow-sm card">
                <div class="p-4 card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h2 class="mb-0 h4" id="calendarTitle">🌙 Calendário Lunar</h2>
                        <div class="btn-group">
                            <button class="btn btn-outline-primary" id="prevMonth">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-outline-primary" id="nextMonth">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <button class="btn btn-outline-primary" onclick="printCalendar()">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="btn btn-outline-primary" onclick="downloadCalendar()">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="calendar" class="table mb-0 table-bordered"></table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações da Lua -->
        <div class="col-lg-4">
            <div class="border-0 shadow-sm card h-100">
                <div class="p-4 card-body">
                    <h2 class="mb-4 h4">🌕 Informações da Lua</h2>
                    <div class="mb-4">
                        <h3 class="mb-3 h5">Fase Atual</h3>
                        <div id="currentPhase" class="p-3 rounded-3 bg-light">
                            <div class="text-center">
                                <span class="mb-2 display-5 d-block">Carregando...</span>
                                <p class="mb-0 text-muted">Detalhes da fase atual</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-3 h5">Trabalhos Recomendados</h3>
                        <div id="recommendedWorks" class="p-3 rounded-3 bg-light">
                            <p class="mb-0 text-muted">Carregando recomendações...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fases da Lua e Trabalhos Mágicos -->
<section class="mb-5">
    <div class="border-0 shadow-sm card">
        <div class="p-4 card-body">
            <h2 class="mb-4 h4">📚 Guia de Trabalhos Mágicos</h2>
        <div class="accordion" id="moonPhasesAccordion">
            <!-- Consagração -->
                <div class="mb-3 border-0 accordion-item">
                <h2 class="accordion-header" id="headingConsagracao">
                        <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseConsagracao" aria-expanded="true" aria-controls="collapseConsagracao">
                        Consagração
                    </button>
                </h2>
                <div id="collapseConsagracao" class="accordion-collapse collapse show" aria-labelledby="headingConsagracao" data-bs-parent="#moonPhasesAccordion">
                    <div class="accordion-body">
                        <ul class="mb-0 list-unstyled">
                            <li>
                                <strong>🌕 Lua Cheia:</strong> Ideal para consagrar objetos de poder, como amuletos, talismãs e ferramentas sagradas. Esta fase potencializa intenções, amplifica a energia espiritual e é excelente para rituais de renovação, fortalecimento pessoal e energização de ambientes. Use-a para infundir força em seus instrumentos e atrair abundância.
                            </li>
                            <li class="mt-2">
                                <strong>🌖 Lua Minguante:</strong> Indicado para consagrar objetos que auxiliam na dissipação de energias negativas. Excelente para rituais de limpeza e purificação, como consagrar varinhas, colheres de pau ou outros instrumentos para preparar remédios naturais e terapias energéticas. Ajuda a eliminar bloqueios e a restaurar o equilíbrio.
                            </li>
                            <li class="mt-2">
                                <strong>🌑 Lua Nova:</strong> Período de novos começos e introspecção, ideal para iniciar processos de consagração que visam o renascimento e a transformação. Utilize essa fase para consagrar objetos que simbolizam o início de um ciclo, plantando intenções para um futuro promissor.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Feitiços e Trabalhos -->
                <div class="mb-3 border-0 accordion-item">
                <h2 class="accordion-header" id="headingFeiticos">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFeiticos" aria-expanded="false" aria-controls="collapseFeiticos">
                        Feitiços e Trabalhos
                    </button>
                </h2>
                <div id="collapseFeiticos" class="accordion-collapse collapse" aria-labelledby="headingFeiticos" data-bs-parent="#moonPhasesAccordion">
                    <div class="accordion-body">
                        <ul class="mb-0 list-unstyled">
                            <li>
                                <strong>🌘 Lua Minguante:</strong> Período propício para desfazer feitiços, banir energias negativas e dissolver amarras emocionais. Excelente para rituais de liberação, limpeza espiritual e encerramento de ciclos que já não servem, permitindo que novas energias entrem.
                            </li>
                            <li class="mt-2">
                                <strong>🌒 Lua Crescente:</strong> Fase ideal para iniciar feitiços que visam o crescimento de negócios, prosperidade e novas oportunidades. Utilize essa energia para semear intenções, estimular a expansão de projetos e fortalecer iniciativas pessoais e profissionais.
                            </li>
                            <li class="mt-2">
                                <strong>🌓 Quarto Crescente:</strong> Momento para intensificar e acelerar feitiços iniciados, fortalecendo projetos e consolidando metas. Essa fase impulsiona a manifestação e é indicada para trabalhos que requerem energia dinâmica e progressiva.
                            </li>
                            <li class="mt-2">
                                <strong>🌗 Quarto Minguante:</strong> Período para trabalhos de encerramento, desapego e transformação. Utilize este tempo para desfazer amarras, eliminar maus hábitos e preparar o terreno para um novo ciclo, liberando o que não mais serve.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Outros Trabalhos e Rituais -->
                <div class="border-0 accordion-item">
                <h2 class="accordion-header" id="headingOutros">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOutros" aria-expanded="false" aria-controls="collapseOutros">
                        Outros Trabalhos e Rituais
                    </button>
                </h2>
                <div id="collapseOutros" class="accordion-collapse collapse" aria-labelledby="headingOutros" data-bs-parent="#moonPhasesAccordion">
                    <div class="accordion-body">
                        <ul class="mb-0 list-unstyled">
                            <li>
                                <strong>🌑 Lua Nova:</strong> Além de iniciar novos ciclos, é um excelente período para meditação profunda e definição de intenções. Indicado para rituais de autoconhecimento, planejamento espiritual e para semear a base de futuros projetos e mudanças internas.
                            </li>
                            <li class="mt-2">
                                <strong>🌕 Lua Cheia:</strong> Favorece rituais de celebração, agradecimento e manifestação. Excelente para trabalhos coletivos, cerimônias de união e para celebrar conquistas, fortalecendo a conexão com a comunidade e a própria essência.
                            </li>
                            <li class="mt-2">
                                <strong>🌒 Lua Crescente:</strong> Recomendado para rituais de fertilidade, criatividade e inovação. Pode ser utilizado em projetos artísticos, para impulsionar a imaginação, estimular a criatividade e fortalecer vínculos afetivos e profissionais.
                            </li>
                            <li class="mt-2">
                                <strong>🌘 Lua Minguante:</strong> Ideal para rituais de banimento e para cortar laços prejudiciais. É um tempo poderoso para a limpeza energética, para desfazer conexões tóxicas e para preparar o campo para um novo começo, com foco na purificação e no restabelecimento da harmonia.
                            </li>
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
        height: 100px;
        vertical-align: top;
        padding: 0.5rem;
    }
    .moon-phase {
        font-size: 0.9rem;
        margin-top: 0.5rem;
        color: #6c757d;
    }
    .today-highlight {
        background-color: #e8f5e9;
        border-radius: 50%;
        display: inline-block;
        padding: 0.25rem 0.5rem;
        font-weight: 600;
    }
    .accordion-button {
        background-color: #f8f9fa;
        border: none;
        padding: 1rem;
    }
    .accordion-button:not(.collapsed) {
        background-color: #e8f5e9;
        color: #198754;
    }
    .accordion-body {
        padding: 1.5rem;
    }
    .list-group-item {
        background: transparent;
        border: none;
    }
    @media print {
        body * {
            visibility: hidden;
        }
        #calendar, #calendar * {
            visibility: visible;
        }
        #calendar {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 0.5rem;
        }
    }
</style>
@stop

@section('js')
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();

    // Função para atualizar o calendário
    function updateCalendar(year, month) {
        const monthName = new Date(year, month).toLocaleString('pt-BR', { month: 'long' });
    document.getElementById("calendarTitle").innerText =
        "🌙 Calendário Lunar - " + monthName.charAt(0).toUpperCase() + monthName.slice(1) + " " + year;

    const firstDay = new Date(year, month, 1);
        const startDay = firstDay.getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const weekDays = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
    const table = document.getElementById("calendar");
        table.innerHTML = '';

        // Cabeçalho
    const thead = document.createElement("thead");
    const headerRow = document.createElement("tr");
    weekDays.forEach(function(day){
        const th = document.createElement("th");
        th.innerText = day;
        headerRow.appendChild(th);
    });
    thead.appendChild(headerRow);
    table.appendChild(thead);

        // Corpo
    const tbody = document.createElement("tbody");
    let currentDay = 1;
    const weeks = Math.ceil((daysInMonth + startDay) / 7);

    for (let i = 0; i < weeks; i++) {
        const row = document.createElement("tr");
        for (let j = 0; j < 7; j++) {
            const cell = document.createElement("td");
            if ((i === 0 && j < startDay) || currentDay > daysInMonth) {
                cell.innerHTML = "";
            } else {
                const dayDiv = document.createElement("div");
                dayDiv.innerHTML = "<strong>" + currentDay + "</strong>";

                    if (currentDay === currentDate.getDate() &&
                        month === currentDate.getMonth() &&
                        year === currentDate.getFullYear()) {
                    dayDiv.classList.add("today-highlight");
                }

                cell.appendChild(dayDiv);

                const phaseSpan = document.createElement("div");
                phaseSpan.className = "moon-phase";
                phaseSpan.innerText = "Carregando...";
                cell.appendChild(phaseSpan);

                const date = new Date(year, month, currentDay, 12, 0, 0);
                const timestamp = Math.floor(date.getTime() / 1000);
                const apiUrl = "https://api.farmsense.net/v1/moonphases/?d=" + timestamp;

                fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        let rawPhase = data[0].Phase.trim();
                        const phasesMap = {
                           "New Moon": "🌑 Lua Nova",
                           "Waxing Crescent": "🌒 Crescente",
                           "First Quarter": "🌓 Quarto Crescente",
                           "1st Quarter": "🌓 Quarto Crescente",
                           "Waxing Gibbous": "🌔 Gibosa Crescente",
                           "Full Moon": "🌕 Lua Cheia",
                           "Waning Gibbous": "🌖 Gibosa Minguante",
                           "Last Quarter": "🌗 Quarto Minguante",
                           "3rd Quarter": "🌗 Quarto Minguante",
                           "Waning Crescent": "🌘 Minguante"
                        };
                        let phase = phasesMap[rawPhase] || rawPhase;
                        phaseSpan.innerText = phase;
                    } else {
                        phaseSpan.innerText = "Indisponível";
                    }
                })
                .catch(err => {
                    phaseSpan.innerText = "Erro";
                });
                currentDay++;
            }
            row.appendChild(cell);
        }
        tbody.appendChild(row);
    }
    table.appendChild(tbody);
    }

    // Eventos dos botões de navegação
    document.getElementById("prevMonth").addEventListener("click", function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        updateCalendar(currentYear, currentMonth);
    });

    document.getElementById("nextMonth").addEventListener("click", function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        updateCalendar(currentYear, currentMonth);
    });

    // Inicializar o calendário
    updateCalendar(currentYear, currentMonth);

    // Atualizar informações da lua atual
    function updateMoonInfo() {
        const now = new Date();
        const timestamp = Math.floor(now.getTime() / 1000);
        const apiUrl = `https://api.farmsense.net/v1/moonphases/?d=${timestamp}`;

        fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
                const currentPhase = data[0];
                const phasesMap = {
                    "New Moon": "🌑 Lua Nova",
                    "Waxing Crescent": "🌒 Crescente",
                    "First Quarter": "🌓 Quarto Crescente",
                    "1st Quarter": "🌓 Quarto Crescente",
                    "Waxing Gibbous": "🌔 Gibosa Crescente",
                    "Full Moon": "🌕 Lua Cheia",
                    "Waning Gibbous": "🌖 Gibosa Minguante",
                    "Last Quarter": "🌗 Quarto Minguante",
                    "3rd Quarter": "🌗 Quarto Minguante",
                    "Waning Crescent": "🌘 Minguante"
                };

                // Atualizar fase atual
                document.querySelector("#currentPhase .display-5").textContent = phasesMap[currentPhase.Phase.trim()];
                document.querySelector("#currentPhase p").textContent = `Iluminação: ${Math.round(currentPhase.Illumination * 100)}%`;

                // Atualizar trabalhos recomendados
                const recommendedWorks = {
                    "New Moon": "Rituais de novos começos, meditação e planejamento",
                    "Waxing Crescent": "Trabalhos de crescimento e expansão",
                    "First Quarter": "Rituais de manifestação e ação",
                    "Waxing Gibbous": "Trabalhos de fortalecimento e preparação",
                    "Full Moon": "Rituais de celebração e manifestação",
                    "Waning Gibbous": "Trabalhos de gratidão e reflexão",
                    "Last Quarter": "Rituais de liberação e transformação",
                    "Waning Crescent": "Trabalhos de limpeza e finalização"
                };

                document.getElementById("recommendedWorks").innerHTML = `
                    <p class="mb-0">${recommendedWorks[currentPhase.Phase.trim()] || "Trabalhos gerais de harmonização"}</p>
                `;
            }
        })
        .catch(err => {
            console.error("Erro ao carregar informações da lua:", err);
        });
    }

    // Atualizar informações da lua a cada hora
    updateMoonInfo();
    setInterval(updateMoonInfo, 3600000);
});

// Função para imprimir apenas o calendário
function printCalendar() {
    window.print();
}

// Função para baixar o calendário como imagem
function downloadCalendar() {
    const calendar = document.getElementById('calendar');
    const monthName = document.getElementById('calendarTitle').textContent;

    // Criar um canvas temporário
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');

    // Configurar o tamanho do canvas
    canvas.width = calendar.offsetWidth;
    canvas.height = calendar.offsetHeight;

    // Desenhar o fundo branco
    context.fillStyle = 'white';
    context.fillRect(0, 0, canvas.width, canvas.height);

    // Desenhar o título
    context.fillStyle = 'black';
    context.font = 'bold 16px Arial';
    context.textAlign = 'center';
    context.fillText(monthName, canvas.width/2, 30);

    // Converter a tabela em imagem
    html2canvas(calendar).then(function(calendarCanvas) {
        context.drawImage(calendarCanvas, 0, 50);

        // Criar link para download
        const link = document.createElement('a');
        link.download = `calendario-lunar-${monthName.toLowerCase().replace(/\s+/g, '-')}.png`;
        link.href = canvas.toDataURL('image/png');
        link.click();
    });
}
</script>
@stop


