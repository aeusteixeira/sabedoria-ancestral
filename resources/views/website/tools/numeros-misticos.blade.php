@extends('layouts.web')

@section('content')
<x-header-page
    complement="Calculadora de Números Místicos"
    title="Números Místicos"
    description="Descubra seus números sagrados e suas influências em sua vida"
/>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="border-0 shadow-sm card">
                <div class="card-body">
                    <form id="numerosForm" class="mb-4">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascimento" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calculator me-2"></i>Calcular Números
                        </button>
                    </form>

                    <div id="resultados" class="d-none">
                        <div class="row g-4">
                            <!-- Número de Vida -->
                            <div class="col-md-6">
                                <div class="numero-card" data-numero="vida">
                                    <div class="numero-icon">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="numero-content">
                                        <h5>Número de Vida</h5>
                                        <div class="numero-valor"></div>
                                        <div class="numero-descricao"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Número de Destino -->
                            <div class="col-md-6">
                                <div class="numero-card" data-numero="destino">
                                    <div class="numero-icon">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="numero-content">
                                        <h5>Número de Destino</h5>
                                        <div class="numero-valor"></div>
                                        <div class="numero-descricao"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Número de Alma -->
                            <div class="col-md-6">
                                <div class="numero-card" data-numero="alma">
                                    <div class="numero-icon">
                                        <i class="fas fa-moon"></i>
                                    </div>
                                    <div class="numero-content">
                                        <h5>Número de Alma</h5>
                                        <div class="numero-valor"></div>
                                        <div class="numero-descricao"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Número de Expressão -->
                            <div class="col-md-6">
                                <div class="numero-card" data-numero="expressao">
                                    <div class="numero-icon">
                                        <i class="fas fa-sun"></i>
                                    </div>
                                    <div class="numero-content">
                                        <h5>Número de Expressão</h5>
                                        <div class="numero-valor"></div>
                                        <div class="numero-descricao"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5>Interpretação Detalhada</h5>
                            <div id="interpretacao" class="interpretacao-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.numero-card {
    background: #fff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.numero-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.numero-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
}

.numero-card[data-numero="vida"] .numero-icon {
    background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
}

.numero-card[data-numero="destino"] .numero-icon {
    background: linear-gradient(135deg, #4ecdc4, #45b7af);
}

.numero-card[data-numero="alma"] .numero-icon {
    background: linear-gradient(135deg, #a78bfa, #8b5cf6);
}

.numero-card[data-numero="expressao"] .numero-icon {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
}

.numero-content {
    flex-grow: 1;
}

.numero-content h5 {
    margin: 0;
    color: #2d3748;
    font-size: 1.1rem;
}

.numero-valor {
    font-size: 2rem;
    font-weight: bold;
    color: #1a202c;
    margin: 0.5rem 0;
}

.numero-descricao {
    font-size: 0.9rem;
    color: #4a5568;
}

.interpretacao-content {
    background: #f8fafc;
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-top: 1rem;
}

.interpretacao-content p {
    margin-bottom: 1rem;
    color: #4a5568;
}

.interpretacao-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.interpretacao-content li {
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.interpretacao-content li::before {
    content: "•";
    position: absolute;
    left: 0;
    color: #4ecdc4;
    font-weight: bold;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.numero-card {
    animation: fadeIn 0.5s ease forwards;
}

.numero-card:nth-child(1) { animation-delay: 0.1s; }
.numero-card:nth-child(2) { animation-delay: 0.2s; }
.numero-card:nth-child(3) { animation-delay: 0.3s; }
.numero-card:nth-child(4) { animation-delay: 0.4s; }
</style>

@section('js')
<script>
const numerosMisticos = {
    1: {
        descricao: "Liderança, independência, criatividade",
        caracteristicas: [
            "Natural líder",
            "Independente e autônomo",
            "Criativo e inovador",
            "Determinado e focado",
            "Individualista"
        ],
        desafios: [
            "Tendência ao egoísmo",
            "Dificuldade em trabalhar em equipe",
            "Pode ser teimoso",
            "Necessidade de controle"
        ]
    },
    2: {
        descricao: "Diplomacia, cooperação, equilíbrio",
        caracteristicas: [
            "Diplomático e cooperativo",
            "Sensível e intuitivo",
            "Pacífico e harmonioso",
            "Bom mediador",
            "Trabalha bem em equipe"
        ],
        desafios: [
            "Indecisão",
            "Dependência emocional",
            "Medo de conflitos",
            "Dificuldade em dizer não"
        ]
    },
    3: {
        descricao: "Expressão, criatividade, otimismo",
        caracteristicas: [
            "Expressivo e comunicativo",
            "Criativo e artístico",
            "Otimista e alegre",
            "Sociável e carismático",
            "Adaptável"
        ],
        desafios: [
            "Superficialidade",
            "Dispersão",
            "Dificuldade em se comprometer",
            "Tendência à exibição"
        ]
    },
    4: {
        descricao: "Estabilidade, organização, trabalho",
        caracteristicas: [
            "Organizado e metódico",
            "Confiável e estável",
            "Trabalhador e dedicado",
            "Prático e realista",
            "Bom planejador"
        ],
        desafios: [
            "Rigidez",
            "Resistência à mudança",
            "Perfeccionismo",
            "Dificuldade em relaxar"
        ]
    },
    5: {
        descricao: "Liberdade, mudança, aventura",
        caracteristicas: [
            "Aventureiro e curioso",
            "Adaptável e versátil",
            "Liberto e independente",
            "Progressista",
            "Versátil"
        ],
        desafios: [
            "Instabilidade",
            "Dificuldade em se comprometer",
            "Impulsividade",
            "Inconstância"
        ]
    },
    6: {
        descricao: "Amor, responsabilidade, harmonia",
        caracteristicas: [
            "Amoroso e carinhoso",
            "Responsável e protetor",
            "Harmonioso e equilibrado",
            "Justo e ético",
            "Bom conselheiro"
        ],
        desafios: [
            "Perfeccionismo",
            "Preocupação excessiva",
            "Dificuldade em dizer não",
            "Tendência ao controle"
        ]
    },
    7: {
        descricao: "Espiritualidade, análise, mistério",
        caracteristicas: [
            "Espiritual e místico",
            "Analítico e investigativo",
            "Introspectivo",
            "Sábio e filosófico",
            "Perfeccionista"
        ],
        desafios: [
            "Isolamento",
            "Ceticismo excessivo",
            "Dificuldade em expressar emoções",
            "Tendência à melancolia"
        ]
    },
    8: {
        descricao: "Poder, abundância, justiça",
        caracteristicas: [
            "Poderoso e ambicioso",
            "Materialmente bem-sucedido",
            "Justo e equilibrado",
            "Líder natural",
            "Organizado"
        ],
        desafios: [
            "Materialismo",
            "Autoritarismo",
            "Tendência ao controle",
            "Dificuldade em relaxar"
        ]
    },
    9: {
        descricao: "Humanitarismo, compaixão, sabedoria",
        caracteristicas: [
            "Humanitário e altruísta",
            "Compassivo e empático",
            "Sábio e intuitivo",
            "Artístico e criativo",
            "Universal"
        ],
        desafios: [
            "Martírio",
            "Dificuldade em estabelecer limites",
            "Tendência ao sacrifício",
            "Sensibilidade excessiva"
        ]
    },
    11: {
        descricao: "Iluminação, inspiração, intuição",
        caracteristicas: [
            "Iluminado e inspirador",
            "Intuitivo e sensitivo",
            "Idealista e visionário",
            "Espiritual",
            "Inovador"
        ],
        desafios: [
            "Nervosismo",
            "Pressão espiritual",
            "Expectativas altas",
            "Dificuldade em se materializar"
        ]
    },
    22: {
        descricao: "Mestre construtor, realização, poder",
        caracteristicas: [
            "Mestre construtor",
            "Poderoso realizador",
            "Visionário prático",
            "Influente",
            "Transformador"
        ],
        desafios: [
            "Pressão de responsabilidade",
            "Expectativas altas",
            "Dificuldade em relaxar",
            "Tendência ao controle"
        ]
    }
};

function calcularNumeroVida(data) {
    const [ano, mes, dia] = data.split('-');
    let soma = parseInt(ano) + parseInt(mes) + parseInt(dia);
    while (soma > 9 && soma !== 11 && soma !== 22) {
        soma = soma.toString().split('').reduce((acc, curr) => acc + parseInt(curr), 0);
    }
    return soma;
}

function calcularNumeroDestino(nome) {
    const valores = {
        'a': 1, 'j': 1, 's': 1,
        'b': 2, 'k': 2, 't': 2,
        'c': 3, 'l': 3, 'u': 3,
        'd': 4, 'm': 4, 'v': 4,
        'e': 5, 'n': 5, 'w': 5,
        'f': 6, 'o': 6, 'x': 6,
        'g': 7, 'p': 7, 'y': 7,
        'h': 8, 'q': 8, 'z': 8,
        'i': 9, 'r': 9
    };

    let soma = 0;
    nome.toLowerCase().replace(/[^a-z]/g, '').split('').forEach(letra => {
        soma += valores[letra] || 0;
    });

    while (soma > 9 && soma !== 11 && soma !== 22) {
        soma = soma.toString().split('').reduce((acc, curr) => acc + parseInt(curr), 0);
    }
    return soma;
}

function calcularNumeroAlma(nome) {
    const vogais = ['a', 'e', 'i', 'o', 'u'];
    const valores = {
        'a': 1, 'j': 1, 's': 1,
        'b': 2, 'k': 2, 't': 2,
        'c': 3, 'l': 3, 'u': 3,
        'd': 4, 'm': 4, 'v': 4,
        'e': 5, 'n': 5, 'w': 5,
        'f': 6, 'o': 6, 'x': 6,
        'g': 7, 'p': 7, 'y': 7,
        'h': 8, 'q': 8, 'z': 8,
        'i': 9, 'r': 9
    };

    let soma = 0;
    nome.toLowerCase().split('').forEach(letra => {
        if (vogais.includes(letra)) {
            soma += valores[letra] || 0;
        }
    });

    while (soma > 9 && soma !== 11 && soma !== 22) {
        soma = soma.toString().split('').reduce((acc, curr) => acc + parseInt(curr), 0);
    }
    return soma;
}

function calcularNumeroExpressao(nome) {
    const valores = {
        'a': 1, 'j': 1, 's': 1,
        'b': 2, 'k': 2, 't': 2,
        'c': 3, 'l': 3, 'u': 3,
        'd': 4, 'm': 4, 'v': 4,
        'e': 5, 'n': 5, 'w': 5,
        'f': 6, 'o': 6, 'x': 6,
        'g': 7, 'p': 7, 'y': 7,
        'h': 8, 'q': 8, 'z': 8,
        'i': 9, 'r': 9
    };

    let soma = 0;
    nome.toLowerCase().replace(/[^a-z]/g, '').split('').forEach(letra => {
        soma += valores[letra] || 0;
    });

    while (soma > 9 && soma !== 11 && soma !== 22) {
        soma = soma.toString().split('').reduce((acc, curr) => acc + parseInt(curr), 0);
    }
    return soma;
}

function atualizarResultados(nome, data) {
    const numeroVida = calcularNumeroVida(data);
    const numeroDestino = calcularNumeroDestino(nome);
    const numeroAlma = calcularNumeroAlma(nome);
    const numeroExpressao = calcularNumeroExpressao(nome);

    // Atualizar cards
    document.querySelector('[data-numero="vida"] .numero-valor').textContent = numeroVida;
    document.querySelector('[data-numero="destino"] .numero-valor').textContent = numeroDestino;
    document.querySelector('[data-numero="alma"] .numero-valor').textContent = numeroAlma;
    document.querySelector('[data-numero="expressao"] .numero-valor').textContent = numeroExpressao;

    // Atualizar descrições
    document.querySelector('[data-numero="vida"] .numero-descricao').textContent = numerosMisticos[numeroVida].descricao;
    document.querySelector('[data-numero="destino"] .numero-descricao').textContent = numerosMisticos[numeroDestino].descricao;
    document.querySelector('[data-numero="alma"] .numero-descricao').textContent = numerosMisticos[numeroAlma].descricao;
    document.querySelector('[data-numero="expressao"] .numero-descricao').textContent = numerosMisticos[numeroExpressao].descricao;

    // Atualizar interpretação detalhada
    const interpretacao = document.getElementById('interpretacao');
    interpretacao.innerHTML = `
        <h6>Número de Vida (${numeroVida})</h6>
        <p>${numerosMisticos[numeroVida].descricao}</p>
        <strong>Características:</strong>
        <ul>
            ${numerosMisticos[numeroVida].caracteristicas.map(c => `<li>${c}</li>`).join('')}
        </ul>
        <strong>Desafios:</strong>
        <ul>
            ${numerosMisticos[numeroVida].desafios.map(d => `<li>${d}</li>`).join('')}
        </ul>

        <h6>Número de Destino (${numeroDestino})</h6>
        <p>${numerosMisticos[numeroDestino].descricao}</p>
        <strong>Características:</strong>
        <ul>
            ${numerosMisticos[numeroDestino].caracteristicas.map(c => `<li>${c}</li>`).join('')}
        </ul>
        <strong>Desafios:</strong>
        <ul>
            ${numerosMisticos[numeroDestino].desafios.map(d => `<li>${d}</li>`).join('')}
        </ul>

        <h6>Número de Alma (${numeroAlma})</h6>
        <p>${numerosMisticos[numeroAlma].descricao}</p>
        <strong>Características:</strong>
        <ul>
            ${numerosMisticos[numeroAlma].caracteristicas.map(c => `<li>${c}</li>`).join('')}
        </ul>
        <strong>Desafios:</strong>
        <ul>
            ${numerosMisticos[numeroAlma].desafios.map(d => `<li>${d}</li>`).join('')}
        </ul>

        <h6>Número de Expressão (${numeroExpressao})</h6>
        <p>${numerosMisticos[numeroExpressao].descricao}</p>
        <strong>Características:</strong>
        <ul>
            ${numerosMisticos[numeroExpressao].caracteristicas.map(c => `<li>${c}</li>`).join('')}
        </ul>
        <strong>Desafios:</strong>
        <ul>
            ${numerosMisticos[numeroExpressao].desafios.map(d => `<li>${d}</li>`).join('')}
        </ul>
    `;

    // Mostrar resultados
    document.getElementById('resultados').classList.remove('d-none');
}

document.getElementById('numerosForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const nome = document.getElementById('nome').value;
    const data = document.getElementById('dataNascimento').value;
    atualizarResultados(nome, data);
});
</script>
@endsection
@endsection
