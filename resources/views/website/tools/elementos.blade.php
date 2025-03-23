@extends('layouts.web')

@section('content')
<x-header-page
    complement="Mapa de Elementos"
    title="Mapa de Elementos"
    description="Explore as forças elementais e suas correspondências místicas"
/>
<div class="container py-4">
    <div class="border-0 shadow-sm card">
        <div class="card-body">
            <div class="row">
                <!-- Mapa de Elementos -->
                <div class="col-md-7">
                    <div class="element-map-container">
                        <div class="element-map">
                            <!-- Norte - Ar -->
                            <div class="element-card air" data-element="ar">
                                <div class="element-icon">🌪️</div>
                                <div class="element-name">Ar</div>
                                <div class="element-direction">Norte</div>
                                <div class="element-symbol">☰</div>
                            </div>

                            <!-- Leste - Fogo -->
                            <div class="element-card fire" data-element="fogo">
                                <div class="element-icon">🔥</div>
                                <div class="element-name">Fogo</div>
                                <div class="element-direction">Leste</div>
                                <div class="element-symbol">⚡</div>
                            </div>

                            <!-- Sul - Terra -->
                            <div class="element-card earth" data-element="terra">
                                <div class="element-icon">🌍</div>
                                <div class="element-name">Terra</div>
                                <div class="element-direction">Sul</div>
                                <div class="element-symbol">⛰️</div>
                            </div>

                            <!-- Oeste - Água -->
                            <div class="element-card water" data-element="agua">
                                <div class="element-icon">💧</div>
                                <div class="element-name">Água</div>
                                <div class="element-direction">Oeste</div>
                                <div class="element-symbol">🌊</div>
                            </div>

                            <!-- Centro - Espírito -->
                            <div class="element-card spirit" data-element="espirito">
                                <div class="element-icon">✨</div>
                                <div class="element-name">Espírito</div>
                                <div class="element-direction">Centro</div>
                                <div class="element-symbol">☯️</div>
                            </div>

                            <!-- Linhas de Conexão -->
                            <div class="element-connections">
                                <div class="connection air-fire"></div>
                                <div class="connection fire-earth"></div>
                                <div class="connection earth-water"></div>
                                <div class="connection water-air"></div>
                                <div class="connection spirit-all"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informações do Elemento -->
                <div class="col-md-5">
                    <div class="element-info-container">
                        <div class="element-info-header">
                            <h5>Informações do Elemento</h5>
                            <div class="element-info-tabs">
                                <button class="tab-btn active" data-tab="propriedades">Propriedades</button>
                                <button class="tab-btn" data-tab="correspondencias">Correspondências</button>
                                <button class="tab-btn" data-tab="ritualizacoes">Ritualizações</button>
                            </div>
                        </div>
                        <div id="element-details" class="element-details">
                            <div class="element-placeholder">
                                <i class="mb-3 fas fa-compass fa-3x"></i>
                                <p>Selecione um elemento para explorar suas propriedades e correspondências.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient {
    background: linear-gradient(135deg, #2c3e50, #3498db);
}

.element-map-container {
    position: relative;
    width: 100%;
    padding-top: 100%;
    margin: 2rem 0;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
}

.element-map {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(3, 1fr);
    gap: 1rem;
    padding: 1rem;
}

.element-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    border-radius: 1rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    text-align: center;
    color: white;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    position: relative;
    overflow: hidden;
}

.element-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.element-card:hover::before {
    opacity: 1;
}

.element-card:hover {
    transform: scale(1.05) translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.element-icon {
    font-size: 3rem;
    margin-bottom: 0.5rem;
    transition: transform 0.3s ease;
}

.element-card:hover .element-icon {
    transform: scale(1.1);
}

.element-name {
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 0.3rem;
}

.element-direction {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-bottom: 0.5rem;
}

.element-symbol {
    font-size: 1.5rem;
    opacity: 0.8;
}

/* Posicionamento dos elementos */
.element-card.air {
    grid-column: 2;
    grid-row: 1;
    background: linear-gradient(135deg, #4a90e2, #357abd);
}

.element-card.fire {
    grid-column: 3;
    grid-row: 2;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
}

.element-card.earth {
    grid-column: 2;
    grid-row: 3;
    background: linear-gradient(135deg, #2ecc71, #27ae60);
}

.element-card.water {
    grid-column: 1;
    grid-row: 2;
    background: linear-gradient(135deg, #3498db, #2980b9);
}

.element-card.spirit {
    grid-column: 2;
    grid-row: 2;
    background: linear-gradient(135deg, #9b59b6, #8e44ad);
}

/* Conexões entre elementos */
.element-connections {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.connection {
    position: absolute;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.connection.air-fire {
    top: 25%;
    right: 25%;
    width: 50%;
    height: 50%;
    border: 2px solid rgba(255,255,255,0.2);
}

.connection.fire-earth {
    bottom: 25%;
    right: 25%;
    width: 50%;
    height: 50%;
    border: 2px solid rgba(255,255,255,0.2);
}

.connection.earth-water {
    bottom: 25%;
    left: 25%;
    width: 50%;
    height: 50%;
    border: 2px solid rgba(255,255,255,0.2);
}

.connection.water-air {
    top: 25%;
    left: 25%;
    width: 50%;
    height: 50%;
    border: 2px solid rgba(255,255,255,0.2);
}

.connection.spirit-all {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30%;
    height: 30%;
    border: 2px solid rgba(255,255,255,0.3);
}

/* Container de Informações */
.element-info-container {
    height: 100%;
    background: #f8f9fa;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.element-info-header {
    margin-bottom: 1.5rem;
}

.element-info-header h5 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.element-info-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.tab-btn {
    padding: 0.5rem 1rem;
    border: none;
    background: #e9ecef;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-btn.active {
    background: #2c3e50;
    color: white;
}

.element-details {
    min-height: 400px;
}

.element-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #6c757d;
    text-align: center;
    padding: 2rem;
}

.element-details h6 {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.element-details ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.element-details li {
    margin-bottom: 0.8rem;
    padding-left: 1.5rem;
    position: relative;
    color: #495057;
}

.element-details li::before {
    content: "•";
    position: absolute;
    left: 0;
    color: #2c3e50;
    font-weight: bold;
}

/* Animações */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.element-card.active {
    animation: pulse 2s infinite;
}

/* Responsividade */
@media (max-width: 768px) {
    .element-map-container {
        margin: 1rem 0;
    }

    .element-info-container {
        margin-top: 2rem;
    }
}
</style>

@section('js')
<script>
const elementData = {
    ar: {
        nome: "Ar",
        direcao: "Norte",
        cor: "#4a90e2",
        propriedades: [
            "Comunicação e expressão",
            "Intelecto e razão",
            "Liberdade e movimento",
            "Inspiração e criatividade",
            "Clareza mental"
        ],
        correspondencias: [
            "Sagrado: Espada",
            "Estação: Outono",
            "Hora: Amanhecer",
            "Signos: Gêmeos, Libra, Aquário",
            "Cores: Amarelo, Branco",
            "Cristais: Ágata azul, Quartzo fumê",
            "Plantas: Lavanda, Alecrim"
        ],
        ritualizacoes: [
            "Respiração consciente e pranayama",
            "Visualização de ventos e tempestades",
            "Trabalho com penas e incensos",
            "Meditação ao ar livre",
            "Rituais de comunicação e expressão",
            "Limpeza energética com ar"
        ]
    },
    fogo: {
        nome: "Fogo",
        direcao: "Leste",
        cor: "#e74c3c",
        propriedades: [
            "Transformação e mudança",
            "Paixão e energia",
            "Vontade e determinação",
            "Criatividade e inspiração",
            "Coragem e força"
        ],
        correspondencias: [
            "Sagrado: Bastão",
            "Estação: Verão",
            "Hora: Amanhecer",
            "Signos: Áries, Leão, Sagitário",
            "Cores: Vermelho, Laranja",
            "Cristais: Rubi, Granada",
            "Plantas: Alecrim, Manjericão"
        ],
        ritualizacoes: [
            "Trabalho com velas e fogueiras",
            "Rituais de transformação",
            "Visualização de chamas",
            "Meditação com fogo",
            "Rituais de proteção",
            "Limpeza energética com fogo"
        ]
    },
    terra: {
        nome: "Terra",
        direcao: "Sul",
        cor: "#2ecc71",
        propriedades: [
            "Estabilidade e segurança",
            "Abundância e prosperidade",
            "Fertilidade e crescimento",
            "Gratidão e conexão",
            "Força e resistência"
        ],
        correspondencias: [
            "Sagrado: Pentáculo",
            "Estação: Inverno",
            "Hora: Noite",
            "Signos: Touro, Virgem, Capricórnio",
            "Cores: Verde, Marrom",
            "Cristais: Esmeralda, Jade",
            "Plantas: Sálvia, Patchouli"
        ],
        ritualizacoes: [
            "Trabalho com cristais e pedras",
            "Jardinagem ritualística",
            "Visualização de montanhas",
            "Rituais de abundância",
            "Meditação com terra",
            "Limpeza energética com terra"
        ]
    },
    agua: {
        nome: "Água",
        direcao: "Oeste",
        cor: "#3498db",
        propriedades: [
            "Emoção e intuição",
            "Cura e purificação",
            "Fluidez e adaptação",
            "Amor e compaixão",
            "Sonhos e mistérios"
        ],
        correspondencias: [
            "Sagrado: Taça",
            "Estação: Primavera",
            "Hora: Crepúsculo",
            "Signos: Câncer, Escorpião, Peixes",
            "Cores: Azul, Prata",
            "Cristais: Água-marinha, Pérola",
            "Plantas: Camomila, Jasmim"
        ],
        ritualizacoes: [
            "Banhos ritualísticos",
            "Trabalho com água e fluidos",
            "Visualização de oceanos",
            "Rituais de cura",
            "Meditação com água",
            "Limpeza energética com água"
        ]
    },
    espirito: {
        nome: "Espírito",
        direcao: "Centro",
        cor: "#9b59b6",
        propriedades: [
            "Unidade e conexão",
            "Consciência e sabedoria",
            "Divindade e transcendência",
            "Equilíbrio e harmonia",
            "Transformação espiritual"
        ],
        correspondencias: [
            "Sagrado: Athame",
            "Estação: Todas",
            "Hora: Todas",
            "Signos: Todos",
            "Cores: Roxo, Dourado",
            "Cristais: Ametista, Diamante",
            "Plantas: Sálvia branca, Rosa"
        ],
        ritualizacoes: [
            "Meditação profunda",
            "Rituais de conexão espiritual",
            "Visualização de luz divina",
            "Rituais de equilíbrio",
            "Trabalho com energia universal",
            "Limpeza energética espiritual"
        ]
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.element-card');
    const tabButtons = document.querySelectorAll('.tab-btn');
    let currentElement = null;
    let currentTab = 'propriedades';

    // Função para atualizar as informações do elemento
    function updateElementInfo(element, tab) {
        const data = elementData[element];
        const details = document.getElementById('element-details');

        let content = '';
        switch(tab) {
            case 'propriedades':
                content = `
                    <h6>Propriedades do Elemento ${data.nome}</h6>
                    <ul>
                        ${data.propriedades.map(p => `<li>${p}</li>`).join('')}
                    </ul>
                `;
                break;
            case 'correspondencias':
                content = `
                    <h6>Correspondências do Elemento ${data.nome}</h6>
                    <ul>
                        ${data.correspondencias.map(c => `<li>${c}</li>`).join('')}
                    </ul>
                `;
                break;
            case 'ritualizacoes':
                content = `
                    <h6>Ritualizações do Elemento ${data.nome}</h6>
                    <ul>
                        ${data.ritualizacoes.map(r => `<li>${r}</li>`).join('')}
                    </ul>
                `;
                break;
        }

        details.innerHTML = content;
    }

    // Event listeners para os cards
    cards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove active class from all cards
            cards.forEach(c => c.classList.remove('active'));

            // Add active class to clicked card
            this.classList.add('active');

            // Update current element and show info
            currentElement = this.dataset.element;
            updateElementInfo(currentElement, currentTab);
        });
    });

    // Event listeners para as tabs
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            tabButtons.forEach(b => b.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Update current tab and show info
            currentTab = this.dataset.tab;
            if (currentElement) {
                updateElementInfo(currentElement, currentTab);
            }
        });
    });
});
</script>
@endsection
@endsection