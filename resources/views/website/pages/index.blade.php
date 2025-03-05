@extends('layouts.web')

@section('content')
<section >
    <x-header-page
        title="✨ Bem-vindo ao Sabedoria Ancestral"
        description="Explore os mistérios da Lua, os planetas regentes e as horas planetárias para potencializar sua jornada espiritual."
    />

    <div class="text-center row">
        <!-- Card da Fase da Lua -->
        <div class="mb-3 col-lg-4">
            <div class="shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">🌙 Fase da Lua Hoje</h5>
                    <p id="cardLuaTexto" class="card-text">Carregando fase da lua...</p>
                    <a class="btn btn-primary" href="{{ route('website.calendario-lunar') }}">
                        Veja o calendário lunar
                    </a>
                </div>
            </div>
        </div>

        <!-- Card do Planeta Regente do Dia -->
        <div class="mb-3 col-lg-4">
            <div class="shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">🪐 Planeta do Dia</h5>
                    <p id="planetaDoDia" class="card-text">Carregando o planeta do dia...</p>
                    <a class="btn btn-primary" href="{{ route('website.planetas') }}">
                        Saiba mais sobre os planetas
                    </a>
                </div>
            </div>
        </div>

        <!-- Card da Hora Planetária Atual -->
        <div class="mb-3 col-lg-4">
            <div class="shadow-sm card">
                <div class="card-body">
                    <h5 class="card-title">🕰️ Hora Planetária Atual</h5>
                    <p id="cardHoraPlanetariaTexto" class="card-text">Carregando hora planetária...</p>
                    <a class="btn btn-primary" href="{{ route('website.hora-planetaria') }}">
                        Veja o calendário completo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="loading" class="my-3 text-center">Carregando dados...</div>
</section>
<!-- Seção de Ervas -->
<section class="py-5 mb-3 shadow-sm bg-green-2 rounded-3">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">
            🌿 Catálogo de ervas
        </h2>
        <p class="text-muted">
            As ervas podem ajudar a potencializar os rituais e aumentar a energia dos feitiços. Explore e descubra o poder das ervas.
        </p>

        <!-- Carrossel -->
        <div id="alchemyCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($herbs->chunk(3) as $index => $herbSet)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            @foreach ($herbSet as $herb)
                                <div class="col-md-4">
                                    <div class="mb-4 border-0 shadow-sm card h-100">
                                        <img src="{{ $herb->image_url }}" class="card-img-top rounded-top"
                                            alt="{{ $herb->name }}" title="{{ $herb->name }}"
                                            style="height: 200px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="text-center card-title fw-bold text-dark">
                                                {{ $herb->name }}
                                            </h5>

                                            <!-- Badge da Categoria -->
                                            <h6 class="flex-wrap gap-2 mb-2 text-center card-subtitle text-body-secondary d-flex justify-content-center">
                                                <x-badge :content="$herb->temperature->name" :colorBackground="$herb->temperature->color_background" :colorText="$herb->temperature->color_text" :icon="$herb->temperature->symbol" />
                                                    <x-badge :content="$herb->planet->name" :colorBackground="$herb->planet->color_background" :colorText="$herb->planet->color_text" :icon="$herb->planet->symbol" />
                                                    <x-badge :content="$herb->element->name" :colorBackground="$herb->element->color_background" :colorText="$herb->element->color_text" :icon="$herb->element->symbol" />
                                            </h6>

                                            <hr>

                                            <p class="text-muted text-start">
                                                {{ Str::limit($herb->description, 120) }}
                                            </p>

                                            <hr>

                                            <div class="mt-auto text-center">
                                                <a href="{{ route('website.herb.show', ['slug' => $herb->slug]) }}" class="btn btn-success w-100">
                                                    ✨ Ver Detalhes
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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

        <a href="{{ route('website.herb.index') }}" class="mt-4 btn btn-primary">
            🔍 Ver Todas as ervas
        </a>
    </div>
</section>
<section class="py-5 mb-3 shadow-sm bg-light rounded-3">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">🔮 Últimas Alquimias</h2>
        <p class="text-muted">
            As alquimias combinam ervas, cristais, planetas e fases lunares para potencializar feitiços e práticas espirituais. Descubra combinações mágicas que ampliam a energia dos rituais.
        </p>

        <!-- Carrossel -->
        <div id="alchemyCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($alchemies->chunk(3) as $index => $alchemySet)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            @foreach ($alchemySet as $alchemy)
                                <div class="col-md-4">
                                    <div class="mb-4 border-0 shadow-sm card h-100">
                                        <img src="{{ $alchemy->image_url }}" class="card-img-top rounded-top"
                                            alt="{{ $alchemy->name }}" title="{{ $alchemy->name }}"
                                            style="height: 200px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="text-center card-title fw-bold text-dark">
                                                {{ $alchemy->name }}
                                            </h5>

                                            <!-- Badge da Categoria -->
                                            <h6 class="flex-wrap gap-2 mb-2 text-center card-subtitle text-body-secondary d-flex justify-content-center">
                                                <x-badge :content="$alchemy->alchemyType->name"
                                                    :colorBackground="$alchemy->alchemyType->color_background"
                                                    :colorText="$alchemy->alchemyType->color_text"
                                                    :icon="$alchemy->alchemyType->symbol" />
                                            </h6>

                                            <hr>

                                            <p class="text-muted text-start">
                                                {!! Str::limit($alchemy->description, 120) !!}
                                            </p>

                                            <hr>

                                            <div class="mt-auto text-center">
                                                <a href="{{ route('website.alchemy.show', ['slug' => $alchemy->slug]) }}" class="btn btn-success w-100">
                                                    ✨ Ver Detalhes
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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

        <a href="{{ route('website.alchemy.index') }}" class="mt-4 btn btn-primary">
            🔍 Ver Todas as Alquimias
        </a>
    </div>
</section>

<!-- Seção de Cursos e Instituto -->
<section class="py-5 mb-3 text-white shadow-sm bg-dark rounded-3">
    <div class="container text-center">
        <h2 class="mb-4">🎓 Conheça Nossos Cursos</h2>
        <p>Aprenda bruxaria, xamanismo e espiritualidade com aulas completas.</p>
        <a href="https://ixani.com.br/cursos" class="btn btn-warning">Ver Cursos</a>
    </div>
</section>

<section class="py-5 mb-3 shadow-sm bg-light rounded-3">
    <div class="container text-center">
        <h2 class="mb-4">🏡 Instituto Xamânico Ancestral</h2>
        <p>Conheça nosso espaço dedicado ao autoconhecimento e conexão espiritual.</p>
        <a href="https://ixani.com.br" class="btn btn-success">Visite Nosso Instituto</a>
    </div>
</section>

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
