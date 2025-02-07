@extends('layouts.web')

@section('title', 'Sabedoria Ancestral')

@section('subtitle')
    Conecte-se com a natureza e com o universo
@stop

@section('content')
<section class="container my-5">
    <div class="mb-4 row">
        <!-- Card da Fase da Lua -->
        <div class="mb-3 col-lg-4">
            <div class="text-center shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">🌙 Fase da lua hoje</h5>
                    <p id="cardLuaTexto" class="card-text">Carregando fase da lua...</p>
                    <a class="btn btn-outline-secondary" href="{{ route('website.calendario-lunar') }}">
                        Veja o calendário lunar
                    </a>
                </div>
            </div>
        </div>
        <!-- Card do planeta regente do dia -->
        <div class="mb-3 col-lg-4">
            <div class="text-center shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">🪐 Planeta do Dia</h5>
                    <p id="planetaDoDia" class="card-text">Carregando o planeta do dia...</p>
                    <a class="btn btn-outline-secondary" href="{{ route('website.planetas') }}">
                        Saiba mais sobre os planetas
                    </a>
                </div>
            </div>
        </div>
        <!-- Card da Hora Planetária Atual -->
        <div class="mb-3 col-lg-4">
            <div class="text-center shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">🕰️ Hora Planetária Atual</h5>
                    <p id="cardHoraPlanetariaTexto" class="card-text">Carregando hora planetária...</p>
                    <a class="btn btn-outline-secondary" href="{{ route('website.hora-planetaria') }}">
                        Veja o calendário completo
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div id="loading" class="my-3 text-center">Carregando dados...</div>
</section>

<!-- Seção de Práticas Espirituais -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-center">Práticas Espirituais</h2>
        <div class="text-center row">
            <div class="mb-4 col-lg-4 col-md-6">
                <div class="shadow-sm card">
                    <div class="card-body">
                        <h5 class="card-title">🕯️ Velas</h5>
                        <p class="card-text">Escolha a vela certa para suas intenções e pedidos.</p>
                        <a href="#" class="btn btn-outline-secondary">Saiba Mais</a>
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-4 col-md-6">
                <div class="shadow-sm card">
                    <div class="card-body">
                        <h5 class="card-title">🪨 Cristais</h5>
                        <p class="card-text">Aprenda sobre as propriedades energéticas dos cristais.</p>
                        <a href="#" class="btn btn-outline-secondary">Descubra</a>
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-4 col-md-6">
                <div class="shadow-sm card">
                    <div class="card-body">
                        <h5 class="card-title">🌙 Fases da Lua</h5>
                        <p class="card-text">Entenda as influências das fases da lua em sua jornada espiritual.</p>
                        <a href="#" class="btn btn-outline-secondary">Saiba Mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    // Mapeamento dos planetas do dia segundo o dia da semana
    const diaPlanetaMap = ["Sol", "Lua", "Marte", "Mercúrio", "Júpiter", "Vênus", "Saturno"];
    // Ordem caldeia tradicional (cíclica)
    const ordemCaldeia = ["Saturno", "Júpiter", "Marte", "Sol", "Vênus", "Mercúrio", "Lua"];

    // Converte uma string de data (UTC) para um objeto Date (o navegador ajusta para o horário local)
    function converterParaLocal(utcString) {
        return new Date(utcString);
    }

    // Formata um objeto Date para o formato HH:MM (24h)
    function formatarHora(date) {
        return date.toLocaleTimeString('pt-BR', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Calcula os horários planetários para os períodos diurno e noturno
    function calcularHorasPlanetarias(sunrise, sunset, nextSunrise, diaRuler) {
        const dayDuration = sunset - sunrise; // duração do período diurno em ms
        const nightDuration = nextSunrise - sunset; // duração do período noturno em ms
        const dayHourDuration = dayDuration / 12;
        const nightHourDuration = nightDuration / 12;

        // Gera a sequência de 24 horas usando a ordem caldeia
        const startIndex = ordemCaldeia.indexOf(diaRuler);
        let planetaryPlanets = [];
        for (let i = 0; i < 24; i++) {
            planetaryPlanets.push(ordemCaldeia[(startIndex + i) % ordemCaldeia.length]);
        }

        let planetaryHours = [];
        // Horas diurnas: 12 períodos iniciando no nascer do sol
        for (let i = 0; i < 12; i++) {
            let horaInicio = new Date(sunrise.getTime() + i * dayHourDuration);
            planetaryHours.push({
                start: horaInicio,
                planeta: planetaryPlanets[i]
            });
        }
        // Horas noturnas: 12 períodos iniciando no pôr do sol
        for (let i = 0; i < 12; i++) {
            let horaInicio = new Date(sunset.getTime() + i * nightHourDuration);
            planetaryHours.push({
                start: horaInicio,
                planeta: planetaryPlanets[i + 12]
            });
        }
        return planetaryHours;
    }

    // Atualiza o card com a hora planetária atual
    function montarHoraPlanetariaAtual(lat, lng) {
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
            const diaSemana = hoje.getDay(); // 0 = domingo, 1 = segunda, etc.
            const diaRuler = diaPlanetaMap[diaSemana];

            const horasPlanetarias = calcularHorasPlanetarias(sunrise, sunset, nextSunrise, diaRuler);

            const now = new Date();
            let horaEncontrada = false;
            horasPlanetarias.forEach((hora, index) => {
                let proximoInicio;
                if (index === 11) {
                    proximoInicio = sunset;
                } else if (index === 23) {
                    proximoInicio = nextSunrise;
                } else {
                    if (index < 12) {
                        proximoInicio = new Date(sunrise.getTime() + (index + 1) * ((sunset - sunrise) /
                            12));
                    } else {
                        proximoInicio = new Date(sunset.getTime() + (index - 11) * ((nextSunrise -
                            sunset) / 12));
                    }
                }
                if (now >= hora.start && now < proximoInicio) {
                    document.getElementById("cardHoraPlanetariaTexto").innerHTML =
                        `<strong>${hora.planeta}</strong><br>${formatarHora(hora.start)} - ${formatarHora(proximoInicio)}`;
                    horaEncontrada = true;
                }
            });
            if (!horaEncontrada) {
                document.getElementById("cardHoraPlanetariaTexto").innerText =
                    "Não foi possível determinar a hora planetária atual.";
            }
            document.getElementById("loading").style.display = "none";
        }).catch(err => {
            console.error(err);
            document.getElementById("loading").innerText = "Erro ao carregar os dados.";
        });
    }

    // Busca a fase da lua usando a API gratuita Farmsense e atualiza o card
    function buscarFaseDaLua() {
        const hoje = new Date();
        const timestamp = Math.floor(hoje.getTime() / 1000);
        const urlLua = `https://api.farmsense.net/v1/moonphases/?d=${timestamp}`;

        fetch(urlLua)
            .then(res => res.json())
            .then(data => {
                if (data && data.length > 0) {
                    let fase = data[0].Phase.trim(); // remove espaços extras
                    // Mapeamento para nomes em português com emojis
                    const fasesMap = {
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
                    const fasePt = fasesMap[fase] || fase;
                    document.getElementById("cardLuaTexto").innerHTML = `<strong>${fasePt}</strong>`;
                } else {
                    document.getElementById("cardLuaTexto").innerText = "Não foi possível obter a fase da lua.";
                }
            })
            .catch(err => {
                console.error(err);
                document.getElementById("cardLuaTexto").innerText = "Erro ao carregar a fase da lua.";
            });
    }

    // Busca o planeta do dia
    function buscarPlanetaDoDia() {
        const hoje = new Date();
        const diaSemana = hoje.getDay(); // 0 = domingo, 1 = segunda, etc.
        const diaRuler = diaPlanetaMap[diaSemana];
        document.getElementById("planetaDoDia").innerHTML = `O planeta que rege hoje é <strong>${diaRuler}</strong>.`;
    }

    // Inicia os processos: obtém localização e atualiza os cards
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            montarHoraPlanetariaAtual(lat, lng);
            buscarFaseDaLua();
            buscarPlanetaDoDia();
        }, err => {
            document.getElementById("loading").innerText = "Erro ao obter localização.";
            buscarFaseDaLua();
            buscarPlanetaDoDia();
        });
    } else {
        document.getElementById("loading").innerText = "Geolocalização não suportada.";
        buscarFaseDaLua();
    }


    // Planeta do dia

</script>
@stop
