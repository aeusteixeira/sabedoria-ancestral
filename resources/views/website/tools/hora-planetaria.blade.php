@extends('layouts.web')

@section('content')
<section>
    <x-header-page
        :title="$seo['title']"
        :description="$seo['description']"
    />
    <div id="loading" class="my-3 text-center">Carregando dados...</div>
    <div class="table-container">
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">Horário</th>
            <th scope="col">Planeta Regente</th>
          </tr>
        </thead>
        <tbody id="planetaryHoursTable" class="table-group-divider">
          <!-- Linhas serão inseridas aqui -->
        </tbody>
      </table>
    </div>
  </section>


@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    // Mapeamento dos planetas do dia segundo o dia da semana:
    // Domingo: Sol, Segunda: Lua, Terça: Marte, Quarta: Mercúrio, Quinta: Júpiter, Sexta: Vênus, Sábado: Saturno.
    const diaPlanetaMap = ["Sol", "Lua", "Marte", "Mercúrio", "Júpiter", "Vênus", "Saturno"];
    // Ordem caldeia tradicional (cíclica)
    const ordemCaldeia = ["Saturno", "Júpiter", "Marte", "Sol", "Vênus", "Mercúrio", "Lua"];

    // Função para converter uma string de data (em UTC) para um objeto Date (o navegador ajusta para o horário local)
    function converterParaLocal(utcString) {
      return new Date(utcString);
    }

    // Função para formatar um objeto Date em HH:MM (formato 24h)
    function formatarHora(date) {
      return date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
    }

    // Função que calcula os horários planetários (diurno e noturno)
    function calcularHorasPlanetarias(sunrise, sunset, nextSunrise, diaRuler) {
      const dayDuration = sunset - sunrise;   // duração do período diurno (ms)
      const nightDuration = nextSunrise - sunset; // duração do período noturno (ms)
      const dayHourDuration = dayDuration / 12;
      const nightHourDuration = nightDuration / 12;

      // Gere a sequência de 24 horas usando a ordem caldeia.
      const startIndex = ordemCaldeia.indexOf(diaRuler);
      let planetaryPlanets = [];
      for (let i = 0; i < 24; i++) {
        planetaryPlanets.push(ordemCaldeia[(startIndex + i) % ordemCaldeia.length]);
      }

      let planetaryHours = [];
      // Horas diurnas: das 0 à 11 (12 horas), iniciando em sunrise
      for (let i = 0; i < 12; i++) {
        let horaInicio = new Date(sunrise.getTime() + i * dayHourDuration);
        planetaryHours.push({ start: horaInicio, planeta: planetaryPlanets[i] });
      }
      // Horas noturnas: das 12 à 23 (12 horas), iniciando em sunset
      for (let i = 0; i < 12; i++) {
        let horaInicio = new Date(sunset.getTime() + i * nightHourDuration);
        planetaryHours.push({ start: horaInicio, planeta: planetaryPlanets[i + 12] });
      }
      return planetaryHours;
    }

    // Função principal para obter dados e montar a tabela
    function montarHorasPlanetarias(lat, lng) {
      // Requisições para a API Sunrise-Sunset para hoje e amanhã
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
        // Converter horários para objetos Date
        const sunrise = converterParaLocal(dataHoje.results.sunrise);
        const sunset = converterParaLocal(dataHoje.results.sunset);
        const nextSunrise = converterParaLocal(dataAmanha.results.sunrise);

        // Determinar o planeta do dia com base no dia da semana local
        const hoje = new Date();
        const diaSemana = hoje.getDay(); // 0 = domingo, 1 = segunda, etc.
        const diaRuler = diaPlanetaMap[diaSemana];

        // Calcula as horas planetárias
        const horasPlanetarias = calcularHorasPlanetarias(sunrise, sunset, nextSunrise, diaRuler);

        // Monta a tabela com destaque para a hora atual
        let tableHTML = "";
        const now = new Date();
        horasPlanetarias.forEach((hora, index) => {
          // Calcula o horário final da hora planetária
          let proximoInicio;
          if (index === 11) {
            proximoInicio = sunset; // última hora diurna termina no pôr do sol
          } else if (index === 23) {
            proximoInicio = nextSunrise; // última hora noturna termina no nascer do sol seguinte
          } else {
            if (index < 12) {
              proximoInicio = new Date(sunrise.getTime() + (index + 1) * ((sunset - sunrise) / 12));
            } else {
              proximoInicio = new Date(sunset.getTime() + (index - 11) * ((nextSunrise - sunset) / 12));
            }
          }

          // Verifica se o horário atual está dentro deste intervalo
          let rowClass = "";
          if (now >= hora.start && now < proximoInicio) {
            rowClass = "table-info"; // destaques usando fundo amarelo
          }

          tableHTML += `<tr class="${rowClass}">
            <td>${formatarHora(hora.start)} - ${formatarHora(proximoInicio)}</td>
            <td>${hora.planeta}</td>
          </tr>`;
        });
        document.getElementById("planetaryHoursTable").innerHTML = tableHTML;
        document.getElementById("loading").style.display = "none";
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
  </script>
@stop
