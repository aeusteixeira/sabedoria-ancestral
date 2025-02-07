@extends('layouts.web')

@section('title', 'Sabedoria Ancestral')

@section('subtitle')
    Conecte-se com a natureza e com o universo
@stop

@section('content')
<section class="container my-5">
    <h1 class="mb-4" id="calendarTitle">Calendário Lunar</h1>
    <p class="mb-4">
        O calendário lunar é uma ferramenta antiga utilizada para acompanhar as fases da Lua ao longo do mês. Cada fase
        lunar possui significados e energias específicas que podem ser aproveitadas em rituais, feitiços e práticas
        espirituais. Descubra as fases da Lua deste mês e como utilizá-las em seus trabalhos mágicos.
    </p>
    <table id="calendar" class="table table-bordered"></table>
    <div class="mt-5">
        <h2 class="mb-4">Fases da Lua e Trabalhos Mágicos</h2>
        <div class="accordion" id="moonPhasesAccordion">
            <!-- Consagração -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingConsagracao">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseConsagracao" aria-expanded="true" aria-controls="collapseConsagracao">
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
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFeiticos">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFeiticos" aria-expanded="false" aria-controls="collapseFeiticos">
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
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOutros">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOutros" aria-expanded="false" aria-controls="collapseOutros">
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
</section>
@stop

@section('css')
<style>
    table {
        width: 100%;
    }
    th, td {
        text-align: center;
        padding: 10px;
        vertical-align: middle;
    }
    .moon-phase {
        font-size: 1.2em;
        margin-top: 5px;
    }
    .today-highlight {
        background-color: #ffeeba;
        border-radius: 50%;
        display: inline-block;
        padding: 5px 10px;
    }
</style>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function(){
    // Data atual e informações do mês
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth(); // 0-indexado
    const monthName = today.toLocaleString('pt-BR', { month: 'long' });
    document.getElementById("calendarTitle").innerText =
        "Calendário Lunar - " + monthName.charAt(0).toUpperCase() + monthName.slice(1) + " " + year;

    // Primeiro dia do mês e número total de dias
    const firstDay = new Date(year, month, 1);
    const startDay = firstDay.getDay(); // 0 (Domingo) a 6 (Sábado)
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    // Cabeçalho do calendário com os dias da semana
    const weekDays = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
    const table = document.getElementById("calendar");
    const thead = document.createElement("thead");
    const headerRow = document.createElement("tr");
    weekDays.forEach(function(day){
        const th = document.createElement("th");
        th.innerText = day;
        headerRow.appendChild(th);
    });
    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Corpo da tabela (tbody) e preenchimento dos dias do mês
    const tbody = document.createElement("tbody");
    let currentDay = 1;
    const weeks = Math.ceil((daysInMonth + startDay) / 7);

    for (let i = 0; i < weeks; i++) {
        const row = document.createElement("tr");
        for (let j = 0; j < 7; j++) {
            const cell = document.createElement("td");
            // Células vazias antes do início do mês ou após o último dia
            if ((i === 0 && j < startDay) || currentDay > daysInMonth) {
                cell.innerHTML = "";
            } else {
                // Cria o elemento para o número do dia
                const dayDiv = document.createElement("div");
                dayDiv.innerHTML = "<strong>" + currentDay + "</strong>";
                // Se for o dia atual, aplica destaque
                if (currentDay === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                    dayDiv.classList.add("today-highlight");
                }
                cell.appendChild(dayDiv);

                // Espaço para a fase lunar
                const phaseSpan = document.createElement("div");
                phaseSpan.className = "moon-phase";
                phaseSpan.innerText = "Carregando...";
                cell.appendChild(phaseSpan);

                // Data para o dia atual ao meio-dia (evitando problemas de timezone)
                const date = new Date(year, month, currentDay, 12, 0, 0);
                const timestamp = Math.floor(date.getTime() / 1000);
                const apiUrl = "https://api.farmsense.net/v1/moonphases/?d=" + timestamp;

                // Chamada à API para obter a fase lunar
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
});
</script>
@stop


