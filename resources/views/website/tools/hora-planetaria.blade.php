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

<!-- Hora Planetária Atual -->
<section class="mb-5">
    <div class="row g-4">
        <!-- Hora Atual -->
        <div class="col-lg-8">
            <div class="border-0 shadow-sm card">
                <div class="p-4 card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h2 class="mb-0 h4">🌍 Hora Planetária Atual</h2>
                        <div class="btn-group">
                            <button class="btn btn-outline-primary" onclick="window.print()">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="btn btn-outline-primary" onclick="downloadTable()">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
    <div id="loading" class="my-3 text-center">Carregando dados...</div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">Horário</th>
            <th scope="col">Planeta Regente</th>
                                    <th scope="col">Correspondências</th>
          </tr>
        </thead>
        <tbody id="planetaryHoursTable" class="table-group-divider">
          <!-- Linhas serão inseridas aqui -->
        </tbody>
      </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações do Planeta -->
        <div class="col-lg-4">
            <div class="border-0 shadow-sm card h-100">
                <div class="p-4 card-body">
                    <h2 class="mb-4 h4">✨ Informações do Planeta</h2>
                    <div class="mb-4">
                        <h3 class="mb-3 h5">Planeta do Dia</h3>
                        <div id="dayPlanet" class="p-3 rounded-3 bg-light">
                            <div class="text-center">
                                <span class="mb-2 display-5 d-block">Carregando...</span>
                                <p class="mb-0 text-muted">Detalhes do planeta regente do dia</p>
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

<!-- Guia de Trabalhos por Planeta -->
<section class="mb-5">
    <div class="border-0 shadow-sm card">
        <div class="p-4 card-body">
            <h2 class="mb-4 h4">📚 Guia de Trabalhos por Planeta</h2>
            <div class="accordion" id="planetaryWorksAccordion">
                <!-- Sol -->
                <div class="mb-3 border-0 accordion-item">
                    <h2 class="accordion-header" id="headingSol">
                        <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSol" aria-expanded="true" aria-controls="collapseSol">
                            ☀️ Sol
                        </button>
                    </h2>
                    <div id="collapseSol" class="accordion-collapse collapse show" aria-labelledby="headingSol" data-bs-parent="#planetaryWorksAccordion">
                        <div class="accordion-body">
                            <p class="mb-0">Trabalhos de poder, autoridade, sucesso, carreira, cura, vitalidade e energia. Ideal para rituais de prosperidade, liderança e fortalecimento pessoal.</p>
                        </div>
                    </div>
                </div>
                <!-- Lua -->
                <div class="mb-3 border-0 accordion-item">
                    <h2 class="accordion-header" id="headingLua">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLua" aria-expanded="false" aria-controls="collapseLua">
                            🌙 Lua
                        </button>
                    </h2>
                    <div id="collapseLua" class="accordion-collapse collapse" aria-labelledby="headingLua" data-bs-parent="#planetaryWorksAccordion">
                        <div class="accordion-body">
                            <p class="mb-0">Trabalhos de intuição, emoções, sonhos, fertilidade, cura emocional e mistérios. Perfeito para rituais de proteção, adivinhação e conexão com o subconsciente.</p>
                        </div>
                    </div>
                </div>
                <!-- Marte -->
                <div class="mb-3 border-0 accordion-item">
                    <h2 class="accordion-header" id="headingMarte">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMarte" aria-expanded="false" aria-controls="collapseMarte">
                            🔥 Marte
                        </button>
                    </h2>
                    <div id="collapseMarte" class="accordion-collapse collapse" aria-labelledby="headingMarte" data-bs-parent="#planetaryWorksAccordion">
                        <div class="accordion-body">
                            <p class="mb-0">Trabalhos de coragem, força, ação, proteção, energia e conquista. Ideal para rituais de proteção, exorcismo e fortalecimento físico.</p>
                        </div>
                    </div>
                </div>
                <!-- Mercúrio -->
                <div class="mb-3 border-0 accordion-item">
                    <h2 class="accordion-header" id="headingMercurio">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMercurio" aria-expanded="false" aria-controls="collapseMercurio">
                            💫 Mercúrio
                        </button>
                    </h2>
                    <div id="collapseMercurio" class="accordion-collapse collapse" aria-labelledby="headingMercurio" data-bs-parent="#planetaryWorksAccordion">
                        <div class="accordion-body">
                            <p class="mb-0">Trabalhos de comunicação, escrita, viagens, comércio e estudos. Perfeito para rituais de comunicação, negócios e aprendizado.</p>
                        </div>
                    </div>
                </div>
                <!-- Júpiter -->
                <div class="mb-3 border-0 accordion-item">
                    <h2 class="accordion-header" id="headingJupiter">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJupiter" aria-expanded="false" aria-controls="collapseJupiter">
                            🌟 Júpiter
                        </button>
                    </h2>
                    <div id="collapseJupiter" class="accordion-collapse collapse" aria-labelledby="headingJupiter" data-bs-parent="#planetaryWorksAccordion">
                        <div class="accordion-body">
                            <p class="mb-0">Trabalhos de abundância, prosperidade, sorte, expansão e sabedoria. Ideal para rituais de abundância, cura e crescimento espiritual.</p>
                        </div>
                    </div>
                </div>
                <!-- Vênus -->
                <div class="mb-3 border-0 accordion-item">
                    <h2 class="accordion-header" id="headingVenus">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVenus" aria-expanded="false" aria-controls="collapseVenus">
                            💝 Vênus
                        </button>
                    </h2>
                    <div id="collapseVenus" class="accordion-collapse collapse" aria-labelledby="headingVenus" data-bs-parent="#planetaryWorksAccordion">
                        <div class="accordion-body">
                            <p class="mb-0">Trabalhos de amor, beleza, harmonia, arte e relacionamentos. Perfeito para rituais de amor, amizade e harmonização.</p>
                        </div>
                    </div>
                </div>
                <!-- Saturno -->
                <div class="border-0 accordion-item">
                    <h2 class="accordion-header" id="headingSaturno">
                        <button class="accordion-button rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSaturno" aria-expanded="false" aria-controls="collapseSaturno">
                            🪐 Saturno
                        </button>
                    </h2>
                    <div id="collapseSaturno" class="accordion-collapse collapse" aria-labelledby="headingSaturno" data-bs-parent="#planetaryWorksAccordion">
                        <div class="accordion-body">
                            <p class="mb-0">Trabalhos de proteção, banimento, limpeza, disciplina e transformação. Ideal para rituais de proteção, banimento e limpeza espiritual.</p>
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
    .table-info {
        background-color: #e8f5e9 !important;
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
        .table-info {
            background-color: #e8f5e9 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>
@stop

@section('js')
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    // Mapeamento dos planetas do dia segundo o dia da semana:
    const diaPlanetaMap = ["Sol", "Lua", "Marte", "Mercúrio", "Júpiter", "Vênus", "Saturno"];
    // Ordem caldeia tradicional (cíclica)
    const ordemCaldeia = ["Saturno", "Júpiter", "Marte", "Sol", "Vênus", "Mercúrio", "Lua"];

    // Correspondências dos planetas
    const correspondenciasPlanetas = {
        "Sol": "☀️ Ouro, Girassol, Louro, Âmbar",
        "Lua": "🌙 Prata, Jasmim, Pérola, Água",
        "Marte": "🔥 Ferro, Pimenta, Rubi, Sangue",
        "Mercúrio": "💫 Mercúrio, Lavanda, Topázio, Ar",
        "Júpiter": "🌟 Estanho, Sálvia, Safira, Madeira",
        "Vênus": "💝 Cobre, Rosa, Esmeralda, Cobre",
        "Saturno": "🪐 Chumbo, Mirra, Ônix, Terra"
    };

    // Trabalhos recomendados por planeta
    const trabalhosRecomendados = {
        "Sol": "Trabalhos de poder, autoridade, sucesso, carreira, cura, vitalidade e energia",
        "Lua": "Trabalhos de intuição, emoções, sonhos, fertilidade, cura emocional e mistérios",
        "Marte": "Trabalhos de coragem, força, ação, proteção, energia e conquista",
        "Mercúrio": "Trabalhos de comunicação, escrita, viagens, comércio e estudos",
        "Júpiter": "Trabalhos de abundância, prosperidade, sorte, expansão e sabedoria",
        "Vênus": "Trabalhos de amor, beleza, harmonia, arte e relacionamentos",
        "Saturno": "Trabalhos de proteção, banimento, limpeza, disciplina e transformação"
    };

    // Função para converter uma string de data (em UTC) para um objeto Date
    function converterParaLocal(utcString) {
      return new Date(utcString);
    }

    // Função para formatar um objeto Date em HH:MM (formato 24h)
    function formatarHora(date) {
      return date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
    }

    // Função que calcula os horários planetários
    function calcularHorasPlanetarias(sunrise, sunset, nextSunrise, diaRuler) {
        const dayDuration = sunset - sunrise;
        const nightDuration = nextSunrise - sunset;
      const dayHourDuration = dayDuration / 12;
      const nightHourDuration = nightDuration / 12;

      const startIndex = ordemCaldeia.indexOf(diaRuler);
      let planetaryPlanets = [];
      for (let i = 0; i < 24; i++) {
        planetaryPlanets.push(ordemCaldeia[(startIndex + i) % ordemCaldeia.length]);
      }

      let planetaryHours = [];
      for (let i = 0; i < 12; i++) {
        let horaInicio = new Date(sunrise.getTime() + i * dayHourDuration);
        planetaryHours.push({ start: horaInicio, planeta: planetaryPlanets[i] });
      }
      for (let i = 0; i < 12; i++) {
        let horaInicio = new Date(sunset.getTime() + i * nightHourDuration);
        planetaryHours.push({ start: horaInicio, planeta: planetaryPlanets[i + 12] });
      }
      return planetaryHours;
    }

    // Função principal para obter dados e montar a tabela
    function montarHorasPlanetarias(lat, lng) {
      const urlHoje = `https://api.sunrise-sunset.org/json?lat=${lat}&lng=${lng}&date=today&formatted=0`;
      const urlAmanha = `https://api.sunrise-sunset.org/json?lat=${lat}&lng=${lng}&date=tomorrow&formatted=0`;

      Promise.all([
        fetch(urlHoje).then(res => res.json()),
        fetch(urlAmanha).then(res => res.json())
      ]).then(([dataHoje, dataAmanha]) => {
        if (dataHoje.status !== "OK" || dataAmanha.status !== "OK") {
          document.getElementById("loading").innerText = "Erro ao obter dados do sol.";
          return;
        }

        const sunrise = converterParaLocal(dataHoje.results.sunrise);
        const sunset = converterParaLocal(dataHoje.results.sunset);
        const nextSunrise = converterParaLocal(dataAmanha.results.sunrise);

        const hoje = new Date();
            const diaSemana = hoje.getDay();
        const diaRuler = diaPlanetaMap[diaSemana];

        const horasPlanetarias = calcularHorasPlanetarias(sunrise, sunset, nextSunrise, diaRuler);

        let tableHTML = "";
        const now = new Date();
        horasPlanetarias.forEach((hora, index) => {
          let proximoInicio;
          if (index === 11) {
                    proximoInicio = sunset;
          } else if (index === 23) {
                    proximoInicio = nextSunrise;
          } else {
            if (index < 12) {
              proximoInicio = new Date(sunrise.getTime() + (index + 1) * ((sunset - sunrise) / 12));
            } else {
              proximoInicio = new Date(sunset.getTime() + (index - 11) * ((nextSunrise - sunset) / 12));
            }
          }

          let rowClass = "";
          if (now >= hora.start && now < proximoInicio) {
                    rowClass = "table-info";
          }

          tableHTML += `<tr class="${rowClass}">
            <td>${formatarHora(hora.start)} - ${formatarHora(proximoInicio)}</td>
            <td>${hora.planeta}</td>
                    <td>${correspondenciasPlanetas[hora.planeta]}</td>
          </tr>`;
        });

        document.getElementById("planetaryHoursTable").innerHTML = tableHTML;
        document.getElementById("loading").style.display = "none";

            // Atualizar informações do planeta do dia
            document.querySelector("#dayPlanet .display-5").textContent = diaRuler;
            document.querySelector("#dayPlanet p").textContent = correspondenciasPlanetas[diaRuler];
            document.getElementById("recommendedWorks").innerHTML = `
                <p class="mb-0">${trabalhosRecomendados[diaRuler]}</p>
            `;
      }).catch(err => {
        console.error(err);
        document.getElementById("loading").innerText = "Erro ao carregar os dados.";
      });
    }

    // Obter a localização do usuário e iniciar o processo
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(position => {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        montarHorasPlanetarias(lat, lng);
      }, err => {
        document.getElementById("loading").innerText = "Erro ao obter localização.";
      });
    } else {
      document.getElementById("loading").innerText = "Geolocalização não suportada.";
    }

    // Função para baixar a tabela como imagem
    function downloadTable() {
        const table = document.querySelector('.table');
        const title = "Hora Planetária";

        html2canvas(table).then(function(canvas) {
            const link = document.createElement('a');
            link.download = `hora-planetaria-${new Date().toLocaleDateString('pt-BR')}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    }
  </script>
@stop
