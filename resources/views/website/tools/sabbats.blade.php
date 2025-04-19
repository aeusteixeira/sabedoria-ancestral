@extends('layouts.web')

@section('content')
<x-header-page
    complement="Roda do Ano"
    title="Sabbats"
    description="Explore os oito festivais sagrados da Roda do Ano e suas energias sazonais"
/>
<div class="container py-4">
    <div class="border-0 shadow-sm card">
        <div class="card-body">
            <!-- Seletor de Hemisfério -->
            <div class="hemisphere-selector mb-4">
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="hemisphere" id="north" value="north" checked>
                    <label class="btn btn-outline-primary" for="north">
                        <i class="fas fa-compass"></i> Roda do Norte
                    </label>

                    <input type="radio" class="btn-check" name="hemisphere" id="south" value="south">
                    <label class="btn btn-outline-primary" for="south">
                        <i class="fas fa-compass fa-rotate-180"></i> Roda do Sul
                    </label>
                </div>
            </div>

            <div class="row">
                <!-- Lista de Sabbats -->
                <div class="col-lg-8 mb-4">
                    <div class="sabbats-list">
                        <!-- Os cards dos sabbats serão inseridos aqui via JavaScript -->
                    </div>
                </div>

                <!-- Coluna Lateral -->
                <div class="col-lg-4">
                    <div class="current-sabbat-card sticky-top" style="top: 2rem;">
                        <div class="card-body">
                            <h4 class="text-center mb-4">Sabbat Atual</h4>
                            <div id="current-sabbat" class="text-center mb-4">
                                <div class="sabbat-icon-large mb-3">
                                    <i class="fas fa-sun"></i>
                                </div>
                                <h3 id="current-sabbat-name">Carregando...</h3>
                                <p id="current-sabbat-date" class="text-muted"></p>
                            </div>

                            <div class="next-sabbat mb-4">
                                <h5 class="text-center">Próximo Sabbat em</h5>
                                <div class="countdown-container">
                                    <div class="countdown-item">
                                        <div class="number" id="countdown-days">00</div>
                                        <div class="label">Dias</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="number" id="countdown-hours">00</div>
                                        <div class="label">Horas</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="number" id="countdown-minutes">00</div>
                                        <div class="label">Min</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="number" id="countdown-seconds">00</div>
                                        <div class="label">Seg</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" id="save-next-sabbat">
                                    <i class="fas fa-calendar-plus"></i> Salvar Próximo Sabbat
                                </button>
                                <button class="btn btn-outline-primary" id="save-all-sabbats">
                                    <i class="fas fa-calendar-alt"></i> Salvar Todos os Sabbats
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Variáveis de cores sazonais */
:root {
    --color-yule: #2c3e50;
    --color-imbolc: #ecf0f1;
    --color-ostara: #27ae60;
    --color-beltane: #e74c3c;
    --color-litha: #f1c40f;
    --color-lughnasadh: #d35400;
    --color-mabon: #8e44ad;
    --color-samhain: #34495e;

    /* Cores dos elementos */
    --element-fire: #e74c3c;
    --element-water: #3498db;
    --element-air: #ecf0f1;
    --element-earth: #8b4513;
    --element-spirit: #9b59b6;
}

/* Estilos gerais */
.sabbats-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.sabbat-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    border-radius: 1rem;
    padding: 1.5rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

/* Cores específicas para cada sabbat */
.sabbat-card[data-sabbat="yule"] {
    border-left: 5px solid var(--color-yule);
    background: linear-gradient(135deg, rgba(44,62,80,0.1) 0%, rgba(44,62,80,0.05) 100%);
}
.sabbat-card[data-sabbat="imbolc"] {
    border-left: 5px solid var(--color-imbolc);
    background: linear-gradient(135deg, rgba(236,240,241,0.1) 0%, rgba(236,240,241,0.05) 100%);
}
.sabbat-card[data-sabbat="ostara"] {
    border-left: 5px solid var(--color-ostara);
    background: linear-gradient(135deg, rgba(39,174,96,0.1) 0%, rgba(39,174,96,0.05) 100%);
}
.sabbat-card[data-sabbat="beltane"] {
    border-left: 5px solid var(--color-beltane);
    background: linear-gradient(135deg, rgba(231,76,60,0.1) 0%, rgba(231,76,60,0.05) 100%);
}
.sabbat-card[data-sabbat="litha"] {
    border-left: 5px solid var(--color-litha);
    background: linear-gradient(135deg, rgba(241,196,15,0.1) 0%, rgba(241,196,15,0.05) 100%);
}
.sabbat-card[data-sabbat="lughnasadh"] {
    border-left: 5px solid var(--color-lughnasadh);
    background: linear-gradient(135deg, rgba(211,84,0,0.1) 0%, rgba(211,84,0,0.05) 100%);
}
.sabbat-card[data-sabbat="mabon"] {
    border-left: 5px solid var(--color-mabon);
    background: linear-gradient(135deg, rgba(142,68,173,0.1) 0%, rgba(142,68,173,0.05) 100%);
}
.sabbat-card[data-sabbat="samhain"] {
    border-left: 5px solid var(--color-samhain);
    background: linear-gradient(135deg, rgba(52,73,94,0.1) 0%, rgba(52,73,94,0.05) 100%);
}

.sabbat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.sabbat-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid rgba(var(--bs-primary-rgb), 0.1);
    padding-bottom: 1rem;
}

.sabbat-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 2.5rem;
    color: white;
    transition: all 0.3s ease;
}

/* Cores dos ícones para cada sabbat */
.sabbat-card[data-sabbat="yule"] .sabbat-icon { background: var(--color-yule); }
.sabbat-card[data-sabbat="imbolc"] .sabbat-icon { background: var(--color-imbolc); color: #2c3e50; }
.sabbat-card[data-sabbat="ostara"] .sabbat-icon { background: var(--color-ostara); }
.sabbat-card[data-sabbat="beltane"] .sabbat-icon { background: var(--color-beltane); }
.sabbat-card[data-sabbat="litha"] .sabbat-icon { background: var(--color-litha); }
.sabbat-card[data-sabbat="lughnasadh"] .sabbat-icon { background: var(--color-lughnasadh); }
.sabbat-card[data-sabbat="mabon"] .sabbat-icon { background: var(--color-mabon); }
.sabbat-card[data-sabbat="samhain"] .sabbat-icon { background: var(--color-samhain); }

/* Cores dos títulos para cada sabbat */
.sabbat-card[data-sabbat="yule"] .sabbat-info h3 {
    color: var(--color-yule);
    -webkit-text-fill-color: initial;
    background: none;
}
.sabbat-card[data-sabbat="imbolc"] .sabbat-info h3 {
    color: #34495e;
    -webkit-text-fill-color: initial;
    background: none;
}
.sabbat-card[data-sabbat="ostara"] .sabbat-info h3 {
    color: var(--color-ostara);
    -webkit-text-fill-color: initial;
    background: none;
}
.sabbat-card[data-sabbat="beltane"] .sabbat-info h3 {
    color: var(--color-beltane);
    -webkit-text-fill-color: initial;
    background: none;
}
.sabbat-card[data-sabbat="litha"] .sabbat-info h3 {
    color: var(--color-litha);
    -webkit-text-fill-color: initial;
    background: none;
    text-shadow: 0 0 10px rgba(241,196,15,0.3);
}
.sabbat-card[data-sabbat="lughnasadh"] .sabbat-info h3 {
    color: var(--color-lughnasadh);
    -webkit-text-fill-color: initial;
    background: none;
}
.sabbat-card[data-sabbat="mabon"] .sabbat-info h3 {
    color: var(--color-mabon);
    -webkit-text-fill-color: initial;
    background: none;
}
.sabbat-card[data-sabbat="samhain"] .sabbat-info h3 {
    color: var(--color-samhain);
    -webkit-text-fill-color: initial;
    background: none;
}

.sabbat-info h3 {
    font-family: 'Cinzel', serif;
    margin: 0;
    font-size: 1.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.sabbat-card:hover .sabbat-info h3 {
    transform: translateY(-2px);
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.element-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.3rem 0.8rem;
    border-radius: 1rem;
    font-size: 0.9rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    color: white;
}

.element-tag.fire {
    background-color: var(--element-fire);
}

.element-tag.water {
    background-color: var(--element-water);
}

.element-tag.air {
    background-color: var(--element-air);
    color: #2c3e50;
}

.element-tag.earth {
    background-color: var(--element-earth);
}

.element-tag.spirit {
    background-color: var(--element-spirit);
}

.sabbat-date {
    color: var(--bs-gray-600);
    font-size: 1rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sabbat-date i {
    color: var(--bs-primary);
}

.sabbat-description {
    color: var(--bs-gray-700);
    margin-bottom: 1.5rem;
    font-style: italic;
    border-left: 3px solid var(--bs-primary);
    padding: 1rem;
    background: rgba(var(--bs-primary-rgb), 0.05);
    border-radius: 0 0.5rem 0.5rem 0;
}

.detail-section {
    background: rgba(255,255,255,0.05);
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}

.detail-section h5 {
    color: var(--bs-primary);
    font-family: 'Cinzel', serif;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-bottom: 2px solid rgba(var(--bs-primary-rgb), 0.1);
    padding-bottom: 0.5rem;
}

.detail-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.detail-section li {
    margin-bottom: 0.8rem;
    color: var(--bs-gray-600);
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 0.5rem;
    border-radius: 0.3rem;
    transition: all 0.2s ease;
}

.detail-section li:hover {
    background: rgba(var(--bs-primary-rgb), 0.05);
}

.detail-section li i {
    color: var(--bs-primary);
    font-size: 1rem;
}

.sabbat-quote {
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: rgba(var(--bs-primary-rgb), 0.05);
    border-radius: 0.5rem;
    font-style: italic;
    color: var(--bs-gray-600);
    position: relative;
}

.sabbat-quote::before {
    content: '"';
    font-size: 4rem;
    position: absolute;
    left: 1rem;
    top: 1rem;
    color: rgba(var(--bs-primary-rgb), 0.1);
    font-family: 'Georgia', serif;
}

/* Estilos para o contador */
.countdown-container {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin: 1.5rem 0;
}

.countdown-item {
    background: rgba(var(--bs-primary-rgb), 0.05);
    padding: 1rem;
    border-radius: 0.5rem;
    min-width: 70px;
    text-align: center;
}

.countdown-item .number {
    font-family: 'Cinzel', serif;
    font-size: 1.8rem;
    color: var(--bs-primary);
    line-height: 1;
}

.countdown-item .label {
    font-size: 0.8rem;
    color: var(--bs-gray-600);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Responsividade */
@media (max-width: 768px) {
    .sabbat-header {
        flex-direction: column;
        text-align: center;
    }

    .sabbat-icon {
        margin: 0 auto;
    }

    .sabbat-details {
        grid-template-columns: 1fr;
    }
}
</style>

@section('js')
<script>
const sabbatsData = {
    yule: {
        nome: "Yule ❄️",
        icon: "snowflake",
        northDate: "21 de Dezembro",
        southDate: "21 de Junho",
        descricao: "O Solstício de Inverno marca o retorno do Sol e o início do alongamento dos dias. É um momento de reflexão interior e renovação.",
        rituais: [
            "🕯️ Acender velas vermelhas e verdes",
            "🌲 Decorar com azevinho e pinheiro",
            "🧘‍♀️ Meditar sobre objetivos futuros",
            "🪵 Ritual do tronco de Yule",
            "👨‍👩‍👧‍👦 Celebração familiar"
        ],
        elementos: [
            { nome: "Terra", emoji: "🌍", classe: "earth" },
            { nome: "Fogo", emoji: "🔥", classe: "fire" }
        ],
        correspondencias: [
            "🎨 Cores: Verde, Vermelho, Dourado",
            "🎄 Símbolos: Azevinho, Pinheiro, Sol",
            "🌿 Ervas: Canela, Noz-moscada, Cedro"
        ],
        citacao: "Na noite mais longa, celebramos o retorno da luz."
    },
    imbolc: {
        nome: "Imbolc 🌱",
        icon: "seedling",
        northDate: "2 de Fevereiro",
        southDate: "1 de Agosto",
        descricao: "Festival da luz crescente e purificação. Celebra o despertar da terra e as primeiras sementes da primavera.",
        rituais: [
            "🕯️ Acender velas brancas",
            "🧹 Limpeza energética do lar",
            "✨ Dedicar-se a novos projetos",
            "🥛 Oferecer leite ou mel à natureza"
        ],
        elementos: [
            { nome: "Fogo", emoji: "🔥", classe: "fire" }
        ],
        correspondencias: [
            "🎨 Cores: Branco, Amarelo",
            "🐑 Símbolos: Vela, Cordeiro, Leite",
            "🌿 Ervas: Camomila, Alecrim, Lavanda"
        ],
        citacao: "Cada vela acesa reacende a esperança no escuro do inverno."
    },
    ostara: {
        nome: "Ostara 🌸",
        icon: "seedling",
        northDate: "21 de Março",
        southDate: "21 de Setembro",
        descricao: "Equinócio da Primavera, momento de equilíbrio perfeito entre luz e escuridão. Celebração do renascimento e fertilidade.",
        rituais: [
            "🌱 Plantar sementes",
            "🥚 Decorar ovos mágicos",
            "🌺 Rituais de fertilidade",
            "🌳 Celebrar ao ar livre"
        ],
        elementos: [
            { nome: "Ar", emoji: "💨", classe: "air" }
        ],
        correspondencias: [
            "🎨 Cores: Verde, Rosa, Amarelo",
            "🐰 Símbolos: Ovos, Lebres, Flores",
            "🌿 Ervas: Verbena, Alecrim, Violeta"
        ],
        citacao: "Tudo floresce na harmonia da luz e da sombra."
    },
    beltane: {
        nome: "Beltane 🔥",
        icon: "fire",
        northDate: "1 de Maio",
        southDate: "31 de Outubro",
        descricao: "Festival do fogo e da paixão. Celebra o auge da primavera e a união dos aspectos masculino e feminino da natureza.",
        rituais: [
            "🔥 Acender fogueiras sagradas",
            "💃 Dançar em volta do mastro",
            "❤️ Rituais de união e amor",
            "🌺 Magias de fertilidade"
        ],
        elementos: [
            { nome: "Fogo", emoji: "🔥", classe: "fire" }
        ],
        correspondencias: [
            "🎨 Cores: Vermelho, Rosa, Verde",
            "🌺 Símbolos: Fogo, Flores, Mastro",
            "🌿 Ervas: Rosas, Artemísia, Verbena"
        ],
        citacao: "Na dança do fogo, a vida celebra seu esplendor."
    },
    litha: {
        nome: "Litha ☀️",
        icon: "sun",
        northDate: "21 de Junho",
        southDate: "21 de Dezembro",
        descricao: "Solstício de Verão, o dia mais longo do ano. Momento de celebrar a luz em seu auge e a abundância da terra.",
        rituais: [
            "🔥 Acender fogueiras ao pôr do sol",
            "🌿 Coletar ervas mágicas",
            "✨ Rituais de prosperidade",
            "💃 Dançar sob o sol"
        ],
        elementos: [
            { nome: "Fogo", emoji: "🔥", classe: "fire" },
            { nome: "Ar", emoji: "💨", classe: "air" }
        ],
        correspondencias: [
            "🎨 Cores: Dourado, Amarelo, Laranja",
            "🌻 Símbolos: Sol, Espigas, Girassol",
            "🌿 Ervas: Erva-de-são-joão, Manjericão"
        ],
        citacao: "No auge da luz solar, celebramos a força da vida."
    },
    lammas: {
        nome: "Lammas 🌾",
        icon: "wheat",
        northDate: "1 de Agosto",
        southDate: "2 de Fevereiro",
        descricao: "Primeira colheita do ano. Momento de gratidão pelos frutos do trabalho e preparação para o outono.",
        rituais: [
            "🍞 Fazer e compartilhar pães",
            "🙏 Rituais de gratidão",
            "📝 Refletir sobre as conquistas",
            "🌾 Decorar com grãos e espigas"
        ],
        elementos: [
            { nome: "Terra", emoji: "🌍", classe: "earth" }
        ],
        correspondencias: [
            "🎨 Cores: Dourado, Marrom, Laranja",
            "🌾 Símbolos: Pães, Grãos, Foice",
            "🌿 Ervas: Girassol, Trigo, Camomila"
        ],
        citacao: "Na colheita dos primeiros frutos, honramos a abundância da Terra."
    },
    mabon: {
        nome: "Mabon 🍂",
        icon: "leaf",
        northDate: "21 de Setembro",
        southDate: "21 de Março",
        descricao: "Equinócio de Outono. Momento de equilíbrio e gratidão pela colheita final do ano.",
        rituais: [
            "🍎 Montar altar de colheita",
            "🍷 Compartilhar vinho e alimentos",
            "⚖️ Meditar sobre equilíbrio",
            "🙏 Rituais de agradecimento"
        ],
        elementos: [
            { nome: "Água", emoji: "💧", classe: "water" },
            { nome: "Terra", emoji: "🌍", classe: "earth" }
        ],
        correspondencias: [
            "🎨 Cores: Vermelho, Marrom, Dourado",
            "🍁 Símbolos: Folhas, Pinhas, Vinho",
            "🌿 Ervas: Sálvia, Alecrim, Mirra"
        ],
        citacao: "No equilíbrio do outono, colhemos a sabedoria do ano."
    },
    samhain: {
        nome: "Samhain 🎃",
        icon: "ghost",
        northDate: "31 de Outubro",
        southDate: "30 de Abril",
        descricao: "Ano Novo Celta e portal entre os mundos. Momento de honrar os ancestrais e se conectar com o mundo espiritual.",
        rituais: [
            "🕯️ Acender velas para ancestrais",
            "🏺 Montar altar dos antepassados",
            "🔮 Práticas divinatórias",
            "✨ Rituais de proteção"
        ],
        elementos: [
            { nome: "Água", emoji: "💧", classe: "water" },
            { nome: "Ar", emoji: "💨", classe: "air" }
        ],
        correspondencias: [
            "🎨 Cores: Preto, Roxo, Laranja",
            "🎃 Símbolos: Abóbora, Caldeirão",
            "🌿 Ervas: Artemísia, Sálvia, Arruda"
        ],
        citacao: "No véu mais fino entre os mundos, dançamos com nossos ancestrais."
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const hemisphereInputs = document.querySelectorAll('input[name="hemisphere"]');
    let currentHemisphere = 'north';
    let countdownInterval;

    // Função para criar card do sabbat (atualizada com emojis e elementos estilizados)
    function createSabbatCard(sabbat, key) {
        const elementosHtml = sabbat.elementos.map(elem =>
            `<span class="element-tag ${elem.classe}">${elem.emoji} ${elem.nome}</span>`
        ).join('');

        return `
            <div class="sabbat-card" data-sabbat="${key}">
                <div class="sabbat-header">
                    <div class="sabbat-icon">
                        <i class="fas fa-${sabbat.icon}"></i>
                    </div>
                    <div class="sabbat-info">
                        <h3>${sabbat.nome}</h3>
                        <div class="sabbat-date">
                            <i class="fas fa-calendar-alt"></i>
                            ${currentHemisphere === 'north' ? sabbat.northDate : sabbat.southDate}
                        </div>
                    </div>
                </div>
                <div class="sabbat-description">
                    ${sabbat.descricao}
                </div>
                <div class="elementos-container mb-3">
                    ${elementosHtml}
                </div>
                <div class="sabbat-details">
                    <div class="detail-section">
                        <h5><i class="fas fa-magic"></i> Rituais</h5>
                        <ul>
                            ${sabbat.rituais.map(ritual => `<li>${ritual}</li>`).join('')}
                        </ul>
                    </div>
                    <div class="detail-section">
                        <h5><i class="fas fa-sun"></i> Correspondências</h5>
                        <ul>
                            ${sabbat.correspondencias.map(corr => `<li>${corr}</li>`).join('')}
                        </ul>
                    </div>
                </div>
                ${sabbat.citacao ? `
                    <div class="sabbat-quote">
                        ${sabbat.citacao}
                    </div>
                ` : ''}
            </div>
        `;
    }

    // Função para atualizar a lista de sabbats
    function updateSabbatsList() {
        const container = document.querySelector('.sabbats-list');
        container.innerHTML = '';

        Object.entries(sabbatsData).forEach(([key, sabbat]) => {
            container.innerHTML += createSabbatCard(sabbat, key);
        });
    }

    // Função para calcular datas dos sabbats
    function getSabbatDates(year) {
        return {
            yule: { north: new Date(year, 11, 21), south: new Date(year, 5, 21) },
            imbolc: { north: new Date(year, 1, 2), south: new Date(year, 7, 1) },
            ostara: { north: new Date(year, 2, 21), south: new Date(year, 8, 21) },
            beltane: { north: new Date(year, 4, 1), south: new Date(year, 9, 31) },
            litha: { north: new Date(year, 5, 21), south: new Date(year, 11, 21) },
            lammas: { north: new Date(year, 7, 1), south: new Date(year, 1, 2) },
            mabon: { north: new Date(year, 8, 21), south: new Date(year, 2, 21) },
            samhain: { north: new Date(year, 9, 31), south: new Date(year, 3, 30) }
        };
    }

    // Função para calcular o sabbat atual e próximo
    function calculateCurrentSabbat() {
        const now = new Date();
        const year = now.getFullYear();
        const dates = getSabbatDates(year);
        const nextYearDates = getSabbatDates(year + 1);

        let currentSabbat = null;
        let nextSabbat = null;
        let nextSabbatDate = null;

        // Combinar datas deste ano e do próximo para verificação
        const allDates = [];
        for (const [name, date] of Object.entries(dates)) {
            allDates.push({
                name,
                date: date[currentHemisphere],
                data: sabbatsData[name]
            });
        }
        // Adicionar primeira data do próximo ano
        const firstNextYear = Object.entries(nextYearDates)[0];
        allDates.push({
            name: firstNextYear[0],
            date: firstNextYear[1][currentHemisphere],
            data: sabbatsData[firstNextYear[0]]
        });

        // Ordenar datas
        allDates.sort((a, b) => a.date - b.date);

        // Encontrar sabbat atual e próximo
        for (let i = 0; i < allDates.length; i++) {
            if (allDates[i].date > now) {
                currentSabbat = i > 0 ? allDates[i - 1] : allDates[allDates.length - 2];
                nextSabbat = allDates[i];
                nextSabbatDate = nextSabbat.date;
                break;
            }
        }

        // Atualizar interface
        const currentSabbatName = document.getElementById('current-sabbat-name');
        const currentSabbatDate = document.getElementById('current-sabbat-date');
        const currentSabbatIcon = document.querySelector('.sabbat-icon-large i');

        if (currentSabbat) {
            currentSabbatName.textContent = currentSabbat.data.nome;
            currentSabbatDate.textContent = currentHemisphere === 'north' ?
                currentSabbat.data.northDate : currentSabbat.data.southDate;
            currentSabbatIcon.className = `fas fa-${currentSabbat.data.icon}`;
        }

        // Iniciar contador para próximo sabbat
        if (nextSabbatDate) {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
            updateCountdown(nextSabbatDate);
            countdownInterval = setInterval(() => updateCountdown(nextSabbatDate), 1000);
        }

        return { current: currentSabbat, next: nextSabbat };
    }

    // Função para atualizar o contador
    function updateCountdown(targetDate) {
        const now = new Date().getTime();
        const distance = targetDate.getTime() - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('countdown-days').textContent = String(days).padStart(2, '0');
        document.getElementById('countdown-hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('countdown-minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('countdown-seconds').textContent = String(seconds).padStart(2, '0');

        if (distance < 0) {
            clearInterval(countdownInterval);
            calculateCurrentSabbat();
        }
    }

    // Função para gerar arquivo ICS
    function generateICS(sabbat, isAll = false) {
        const year = new Date().getFullYear();
        const dates = getSabbatDates(year);
        let events = [];

        if (isAll) {
            for (const [name, date] of Object.entries(dates)) {
                const sabbatData = sabbatsData[name];
                events.push({
                    name: sabbatData.nome,
                    date: date[currentHemisphere],
                    description: sabbatData.descricao
                });
            }
        } else {
            events.push({
                name: sabbat.data.nome,
                date: sabbat.date,
                description: sabbat.data.descricao
            });
        }

        let icsContent = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//Sabedoria Ancestral//Sabbats//PT_BR',
            'CALSCALE:GREGORIAN'
        ];

        events.forEach(event => {
            const dateStr = event.date.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';
            const endDate = new Date(event.date);
            endDate.setDate(endDate.getDate() + 1);
            const endDateStr = endDate.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';

            icsContent = icsContent.concat([
                'BEGIN:VEVENT',
                `UID:${Math.random().toString(36).substring(2)}@sabedoria-ancestral`,
                `DTSTAMP:${new Date().toISOString().replace(/[-:]/g, '').split('.')[0]}Z`,
                `DTSTART:${dateStr}`,
                `DTEND:${endDateStr}`,
                `SUMMARY:${event.name}`,
                `DESCRIPTION:${event.description}`,
                'END:VEVENT'
            ]);
        });

        icsContent.push('END:VCALENDAR');

        const blob = new Blob([icsContent.join('\r\n')], { type: 'text/calendar' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = isAll ? 'todos-sabbats.ics' : `sabbat-${sabbat.name}.ics`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }

    // Event listeners
    hemisphereInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            currentHemisphere = e.target.value;
            updateSabbatsList();
            const { next } = calculateCurrentSabbat();
        });
    });

    // Event listeners para os botões de calendário
    document.getElementById('save-next-sabbat').addEventListener('click', () => {
        const { next } = calculateCurrentSabbat();
        if (next) {
            generateICS(next);
        }
    });

    document.getElementById('save-all-sabbats').addEventListener('click', () => {
        generateICS(null, true);
    });

    // Inicialização
    updateSabbatsList();
    calculateCurrentSabbat();
});
</script>
@endsection
@endsection