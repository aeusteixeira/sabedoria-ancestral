@extends('layouts.web')

@section('content')
<!-- Hero Section -->
<section class="py-6 mb-5 overflow-hidden position-relative">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="mb-3">
                    <span class="px-3 py-2 badge bg-success bg-opacity-10 text-success">
                        Bem-vindo
                    </span>
                </div>
                <h1 class="mb-4 display-2 fw-bold font-cinzel">
                    <span class="me-2">✨</span>Sabedoria Ancestral
                </h1>
                <p class="mb-4 lead text-muted">
                    <span class="me-2">🌙</span>Explore os mistérios da Lua, os planetas regentes e as horas planetárias para potencializar sua jornada espiritual.
                </p>
                <div class="gap-3 d-flex">
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">
                        <span class="me-2">✨</span>Junte-se a nós
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-success btn-lg">
                        <span class="me-2">🌟</span>Já sou membro
                    </a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="position-relative">
                    <div class="top-0 position-absolute start-0 w-100 h-100 bg-success bg-opacity-10 rounded-4"></div>
                    <img src="https://serpentedacura.com/wp-content/uploads/2023/03/sabedoria-ancestral.jpg" alt="Sabedoria Ancestral" class="shadow-lg img-fluid rounded-4 position-relative">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cards de Informação -->
<section class="mb-5">
    <div class="row g-4">
        <!-- Card da Fase da Lua -->
        <div class="col-lg-4">
            <div class="border-0 shadow-sm h-100 card">
                <div class="p-4 text-center card-body">
                    <div class="mb-4">
                        <span class="display-4">🌙</span>
                    </div>
                    <h5 class="mb-3 card-title">Fase da Lua Hoje</h5>
                    <p id="cardLuaTexto" class="mb-4 card-text">Carregando fase da lua...</p>
                    <a class="w-100 btn btn-primary" href="{{ route('website.calendario-lunar') }}">
                        <span class="me-2">📅</span>Veja o calendário lunar
                    </a>
                </div>
            </div>
        </div>

        <!-- Card do Planeta Regente do Dia -->
        <div class="col-lg-4">
            <div class="border-0 shadow-sm h-100 card">
                <div class="p-4 text-center card-body">
                    <div class="mb-4">
                        <span class="display-4">🪐</span>
                    </div>
                    <h5 class="mb-3 card-title">Planeta do Dia</h5>
                    <p id="planetaDoDia" class="mb-4 card-text">Carregando o planeta do dia...</p>
                    <a class="w-100 btn btn-primary" href="{{ route('website.planetas') }}">
                        <span class="me-2">🌍</span>Saiba mais sobre os planetas
                    </a>
                </div>
            </div>
        </div>

        <!-- Card da Hora Planetária Atual -->
        <div class="col-lg-4">
            <div class="border-0 shadow-sm h-100 card">
                <div class="p-4 text-center card-body">
                    <div class="mb-4">
                        <span class="display-4">🕰️</span>
                    </div>
                    <h5 class="mb-3 card-title">Hora Planetária Atual</h5>
                    <p id="cardHoraPlanetariaTexto" class="mb-4 card-text">Carregando hora planetária...</p>
                    <a class="w-100 btn btn-primary" href="{{ route('website.hora-planetaria') }}">
                        <span class="me-2">⏰</span>Veja o calendário completo
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="loading" class="mb-5 text-center">Carregando dados...</div>

<!-- Seção da Comunidade -->
<section class="py-5 mb-4 shadow-sm bg-light rounded-3">
    <div class="container">
        <div class="mb-4 text-center">
            <h2 class="mb-3 fw-bold">🌟 Nossa Comunidade</h2>
            <p class="mb-0 text-muted">
                Explore os recursos e serviços disponíveis em nossa comunidade espiritual
            </p>
        </div>

        <div class="row g-4">
            <!-- Serviços Esotéricos -->
            <div class="col-md-6 col-lg-4">
                <div class="shadow-sm h-100 card">
                    <div class="p-4 text-center card-body">
                        <div class="mb-3">
                            <span class="display-4">⚡</span>
                        </div>
                        <h3 class="mb-3 h5">Serviços Esotéricos</h3>
                        <p class="mb-4 text-muted">
                            Consultas de Tarot, Baralho Cigano e Horóscopo realizadas por membros experientes da comunidade.
                        </p>
                        <a href="{{ route('website.service.index') }}" class="btn btn-primary">
                            <span class="me-2">✨</span>Explorar Serviços
                        </a>
                    </div>
                </div>
            </div>

            <!-- Magias e Feitiços -->
            <div class="col-md-6 col-lg-4">
                <div class="shadow-sm h-100 card">
                    <div class="p-4 text-center card-body">
                        <div class="mb-3">
                            <span class="display-4">🔮</span>
                        </div>
                        <h3 class="mb-3 h5">Magias e Feitiços</h3>
                        <p class="mb-4 text-muted">
                            Compartilhe e descubra rituais, feitiços e práticas mágicas com outros membros da comunidade.
                        </p>
                        <a href="{{ route('website.alchemy.index') }}" class="btn btn-dark">
                            <span class="me-2">🌟</span>Ver Magias
                        </a>
                    </div>
                </div>
            </div>

            <!-- Catálogo de Ervas -->
            <div class="col-md-6 col-lg-4">
                <div class="shadow-sm h-100 card">
                    <div class="p-4 text-center card-body">
                        <div class="mb-3">
                            <span class="display-4">🌿</span>
                        </div>
                        <h3 class="mb-3 h5">Catálogo de Ervas</h3>
                        <p class="mb-4 text-muted">
                            Explore nossa coleção de ervas mágicas, suas propriedades e usos em rituais e práticas espirituais.
                        </p>
                        <a href="{{ route('website.herb.index') }}" class="btn btn-success">
                            <span class="me-2">🌱</span>Ver Ervas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção de Ervas -->
<section class="py-5 mb-4 shadow-sm bg-green-2 rounded-3">
    <div class="container">
        <div class="mb-4 text-center">
            <h2 class="mb-3 fw-bold">🌿 Catálogo de ervas</h2>
            <p class="mb-0 text-muted">
                As ervas podem ajudar a potencializar os rituais e aumentar a energia dos feitiços. Explore e descubra o poder das ervas.
            </p>
        </div>

        <!-- Carrossel -->
        <div id="herbsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($herbs->chunk(3) as $index => $herbSet)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">
                            @foreach ($herbSet as $herb)
                                <div class="col-md-4">
                                    <x-card :item="$herb" route="website.herb.show" type="herb" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Controles do Carrossel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#herbsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#herbsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('website.herb.index') }}" class="btn btn-primary">
                <span class="me-2">🔍</span>Ver Todas as ervas
            </a>
        </div>
    </div>
</section>

<!-- Seção de Alquimias -->
<section class="py-5 mb-4 shadow-sm bg-light rounded-3">
    <div class="container">
        <div class="mb-4 text-center">
            <h2 class="mb-3 fw-bold">🔮 Últimas Alquimias</h2>
            <p class="mb-0 text-muted">
                As alquimias combinam ervas, cristais, planetas e fases lunares para potencializar feitiços e práticas espirituais. Descubra combinações mágicas que ampliam a energia dos rituais.
            </p>
        </div>

        <!-- Carrossel -->
        <div id="alchemyCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($alchemies->chunk(3) as $index => $alchemySet)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">
                            @foreach ($alchemySet as $alchemy)
                                <div class="col-md-4">
                                    <x-card :item="$alchemy" route="website.alchemy.show" type="alchemy" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Controles do Carrossel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#alchemyCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#alchemyCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('website.alchemy.index') }}" class="btn btn-primary">
                <span class="me-2">🔍</span>Ver Todas as Alquimias
            </a>
        </div>
    </div>
</section>

<!-- Seção de Cursos -->
<section class="py-5 mb-4 text-white shadow-sm bg-dark rounded-3">
    <div class="container">
        <div class="text-center">
            <h2 class="mb-3">🎓 Conheça Nossos Cursos</h2>
            <p class="mb-4">Aprenda bruxaria, xamanismo e espiritualidade com aulas completas.</p>
            <a href="https://ixani.com.br/cursos" class="btn btn-warning">
                <span class="me-2">📚</span>Ver Cursos
            </a>
        </div>
    </div>
</section>

<!-- Seção do Instituto -->
<section class="py-5 mb-4 shadow-sm bg-light rounded-3">
    <div class="container">
        <div class="text-center">
            <h2 class="mb-3">🏡 Instituto Xamânico Ancestral</h2>
            <p class="mb-4">Conheça nosso espaço dedicado ao autoconhecimento e conexão espiritual.</p>
            <a href="https://ixani.com.br" class="btn btn-success">
                <span class="me-2">🏛️</span>Visite Nosso Instituto
            </a>
        </div>
    </div>
</section>

<style>

</style>
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
