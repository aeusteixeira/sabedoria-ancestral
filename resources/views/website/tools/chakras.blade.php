@extends('layouts.web')

@section('content')
<x-header-page
    complement="Mapa de Chakras"
    title="Chakras"
    description="Explore seus centros de energia e descubra seu equilíbrio espiritual"
/>

<div class="container py-4">
    <div class="row">
        <!-- Coluna Principal -->
        <div class="mb-4 col-lg-8 mb-lg-0">
            <div class="border-0 rounded-lg shadow-lg card chakras-card">
                <div class="card-body">
                    <!-- Lista de Chakras -->
                    <div class="chakras-container">
                        @foreach (['coroa','terceiro-olho','garganta','cardiaco','plexo-solar','sacral','raiz'] as $chakra)
                        <div class="chakra-item" data-chakra="{{ $chakra }}">
                            <div class="chakra-icon">
                                @if($chakra=='coroa')
                                    <i class="fas fa-crown"></i>
                                @elseif($chakra=='terceiro-olho')
                                    <i class="fas fa-eye"></i>
                                @elseif($chakra=='garganta')
                                    <i class="fas fa-comment"></i>
                                @elseif($chakra=='cardiaco')
                                    <i class="fas fa-heart"></i>
                                @elseif($chakra=='plexo-solar')
                                    <i class="fas fa-sun"></i>
                                @elseif($chakra=='sacral')
                                    <i class="fas fa-water"></i>
                                @elseif($chakra=='raiz')
                                    <i class="fas fa-mountain"></i>
                                @endif
                            </div>
                            <div class="chakra-info">
                                <h5>Chakra {{ ucfirst($chakra) }}</h5>
                                <div class="chakra-details">
                                    <p class="descricao"></p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="caracteristicas">
                                                <h6><i class="fas fa-star me-2"></i>Características</h6>
                                                <ul></ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="desequilibrio">
                                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Desequilíbrio</h6>
                                                <ul></ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="equilibrio">
                                                <h6><i class="fas fa-balance-scale me-2"></i>Equilíbrio</h6>
                                                <ul></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 chakra-practices">
                                        <h6><i class="fas fa-spa me-2"></i>Práticas Recomendadas</h6>
                                        <div class="practices-grid"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Coluna Lateral -->
        <div class="col-lg-4">
            <div class="mb-4">
                <div class="border-0 shadow-sm card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-info-circle me-2"></i>Sobre os Chakras</h5>
                        <p class="card-text">Os chakras são centros de energia vital que regulam diferentes aspectos do nosso ser físico, emocional e espiritual.</p>
                        <div class="chakra-tips">
                            <h6 class="mt-3"><i class="fas fa-lightbulb me-2"></i>Dicas para Equilíbrio</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i>Meditação diária</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Respiração consciente</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Yoga e exercícios físicos</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Alimentação equilibrada</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="border-0 shadow-sm card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-palette me-2"></i>Cores e Elementos</h5>
                        <div class="color-guide">
                            <div class="color-item" style="background: linear-gradient(135deg, #8b5cf6, #6366f1);">
                                <i class="fas fa-crown me-2"></i>
                                <span>Coroa - Violeta</span>
                            </div>
                            <div class="color-item" style="background: linear-gradient(135deg, #6366f1, #4f46e5);">
                                <i class="fas fa-eye me-2"></i>
                                <span>Terceiro Olho - Índigo</span>
                            </div>
                            <div class="color-item" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                <i class="fas fa-comment me-2"></i>
                                <span>Garganta - Azul</span>
                            </div>
                            <div class="color-item" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <i class="fas fa-heart me-2"></i>
                                <span>Cardíaco - Verde</span>
                            </div>
                            <div class="color-item" style="background: linear-gradient(135deg, #fbbf24, #f59e0b);">
                                <i class="fas fa-sun me-2"></i>
                                <span>Plexo Solar - Amarelo</span>
                            </div>
                            <div class="color-item" style="background: linear-gradient(135deg, #f97316, #ea580c);">
                                <i class="fas fa-water me-2"></i>
                                <span>Sacral - Laranja</span>
                            </div>
                            <div class="color-item" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                <i class="fas fa-mountain me-2"></i>
                                <span>Raiz - Vermelho</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="border-0 shadow-sm card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-om me-2"></i>Meditação Guiada</h5>
                        <p class="card-text">Experimente nossa meditação guiada para equilibrar seus chakras.</p>
                        <button class="btn btn-outline-primary w-100">
                            <i class="fas fa-play-circle me-2"></i>Iniciar Meditação
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Ajustes Gerais */
.chakras-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 1.5rem;
    overflow: hidden;
}

/* Lista de Chakras */
.chakras-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    padding: 1rem;
}

.chakra-item {
    background: #fff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    position: relative;
}

.chakra-item:hover {
    transform: translateX(10px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.chakra-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: #fff;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Cores para cada chakra */
.chakra-item[data-chakra="coroa"] .chakra-icon { background: linear-gradient(135deg, #8b5cf6, #6366f1); }
.chakra-item[data-chakra="terceiro-olho"] .chakra-icon { background: linear-gradient(135deg, #6366f1, #4f46e5); }
.chakra-item[data-chakra="garganta"] .chakra-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.chakra-item[data-chakra="cardiaco"] .chakra-icon { background: linear-gradient(135deg, #10b981, #059669); }
.chakra-item[data-chakra="plexo-solar"] .chakra-icon { background: linear-gradient(135deg, #fbbf24, #f59e0b); }
.chakra-item[data-chakra="sacral"] .chakra-icon { background: linear-gradient(135deg, #f97316, #ea580c); }
.chakra-item[data-chakra="raiz"] .chakra-icon { background: linear-gradient(135deg, #ef4444, #dc2626); }

.chakra-info h5 {
    margin: 0;
    color: #2d3748;
    font-size: 1.2rem;
    font-weight: 600;
}

.chakra-details {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
}

.chakra-details h6 {
    color: #4a5568;
    font-size: 1rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.chakra-details p {
    color: #4a5568;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.chakra-details ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.chakra-details li {
    color: #4a5568;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.chakra-details li::before {
    content: "•";
    position: absolute;
    left: 0;
    color: var(--chakra-color, #ccc);
    font-weight: bold;
}

/* Práticas Recomendadas */
.practices-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.practice-item {
    background: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1rem;
    transition: transform 0.2s ease;
}

.practice-item:hover {
    transform: translateY(-2px);
}

.practice-item h6 {
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.practice-item p {
    color: #4a5568;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.practice-item small {
    color: #718096;
}

/* Guia de Cores */
.color-guide {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.color-item {
    padding: 0.75rem;
    border-radius: 0.5rem;
    color: #fff;
    font-weight: 500;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
}

/* Ajustes para dispositivos móveis */
@media (max-width: 768px) {
    .chakra-item {
        flex-direction: column;
        text-align: center;
        padding: 1rem;
    }

    .chakra-icon {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
        margin: 0 auto;
    }

    .chakra-info h5 {
        font-size: 1.1rem;
    }
}
</style>

@section('js')
<script>
// Dados dos chakras
const chakras = {
    coroa: {
        nome: "Chakra Coroa",
        descricao: "O chakra coroa representa nossa conexão com o divino e a consciência universal.",
        caracteristicas: [
            "Espiritualidade elevada",
            "Sintonia com o universo",
            "Sabedoria superior",
            "Paz interior",
            "Iluminação"
        ],
        desequilibrio: [
            "Ceticismo excessivo",
            "Desconexão espiritual",
            "Dores de cabeça",
            "Confusão mental",
            "Isolamento"
        ],
        equilibrio: [
            "Meditação regular",
            "Práticas espirituais",
            "Conexão com a natureza",
            "Visualização de luz branca",
            "Práticas de gratidão"
        ],
        practices: [
            {
                nome: "Meditação da Luz",
                descricao: "Visualize uma luz branca descendo sobre você",
                duracao: "10-15 minutos"
            },
            {
                nome: "Conexão com a Natureza",
                descricao: "Passe tempo ao ar livre, conectando-se com a terra",
                duracao: "20-30 minutos"
            }
        ]
    },
    "terceiro-olho": {
        nome: "Chakra Terceiro Olho",
        descricao: "O chakra do terceiro olho governa nossa intuição e percepção extra-sensorial.",
        caracteristicas: [
            "Intuição forte",
            "Clarividência",
            "Imaginação fértil",
            "Sensibilidade",
            "Visão interior"
        ],
        desequilibrio: [
            "Dores de cabeça",
            "Problemas de visão",
            "Insônia",
            "Ansiedade",
            "Dificuldade de concentração"
        ],
        equilibrio: [
            "Meditação",
            "Visualização",
            "Práticas de intuição",
            "Contato com a natureza",
            "Exercícios de respiração"
        ],
        practices: [
            {
                nome: "Visualização do Terceiro Olho",
                descricao: "Foque sua atenção no ponto entre as sobrancelhas",
                duracao: "5-10 minutos"
            },
            {
                nome: "Exercício de Intuição",
                descricao: "Pratique adivinhar pequenas coisas do dia a dia",
                duracao: "15-20 minutos"
            }
        ]
    },
    garganta: {
        nome: "Chakra Garganta",
        descricao: "O chakra da garganta está relacionado à comunicação e expressão pessoal.",
        caracteristicas: [
            "Boa comunicação",
            "Expressão criativa",
            "Honestidade",
            "Confiança",
            "Autenticidade"
        ],
        desequilibrio: [
            "Dificuldade de expressão",
            "Problemas de voz",
            "Timidez",
            "Mentiras",
            "Tensão no pescoço"
        ],
        equilibrio: [
            "Canto",
            "Escrita",
            "Arte",
            "Respiração consciente",
            "Expressão criativa"
        ],
        practices: [
            {
                nome: "Canto de Mantras",
                descricao: "Cante o mantra OM em diferentes tons",
                duracao: "10-15 minutos"
            },
            {
                nome: "Escrita Expressiva",
                descricao: "Escreva seus pensamentos sem censura",
                duracao: "15-20 minutos"
            }
        ]
    },
    cardiaco: {
        nome: "Chakra Cardíaco",
        descricao: "O chakra cardíaco é o centro do amor, compaixão e conexão emocional.",
        caracteristicas: [
            "Amor incondicional",
            "Compaixão",
            "Empatia",
            "Harmonia",
            "Paz interior"
        ],
        desequilibrio: [
            "Dificuldade de amar",
            "Isolamento emocional",
            "Problemas cardíacos",
            "Raiva",
            "Mágoas"
        ],
        equilibrio: [
            "Práticas de amor",
            "Meditação do coração",
            "Yoga",
            "Terapia",
            "Conexão com pessoas"
        ],
        practices: [
            {
                nome: "Meditação do Amor",
                descricao: "Visualize amor e compaixão emanando do seu coração",
                duracao: "10-15 minutos"
            },
            {
                nome: "Prática de Gratidão",
                descricao: "Liste 5 coisas pelas quais você é grato",
                duracao: "5-10 minutos"
            }
        ]
    },
    "plexo-solar": {
        nome: "Chakra Plexo Solar",
        descricao: "O chakra do plexo solar está relacionado ao poder pessoal e autoconfiança.",
        caracteristicas: [
            "Autoconfiança",
            "Poder pessoal",
            "Determinação",
            "Vitalidade",
            "Força de vontade"
        ],
        desequilibrio: [
            "Baixa autoestima",
            "Insegurança",
            "Problemas digestivos",
            "Raiva",
            "Controle excessivo"
        ],
        equilibrio: [
            "Exercícios físicos",
            "Autoconhecimento",
            "Terapia",
            "Meditação",
            "Práticas de empoderamento"
        ],
        practices: [
            {
                nome: "Exercícios de Poder",
                descricao: "Pratique posturas de poder e afirmações positivas",
                duracao: "10-15 minutos"
            },
            {
                nome: "Meditação Solar",
                descricao: "Visualize luz dourada no seu plexo solar",
                duracao: "5-10 minutos"
            }
        ]
    },
    sacral: {
        nome: "Chakra Sacral",
        descricao: "O chakra sacral está relacionado à criatividade, prazer e emoções.",
        caracteristicas: [
            "Criatividade",
            "Prazer",
            "Emoções equilibradas",
            "Sexualidade saudável",
            "Alegria"
        ],
        desequilibrio: [
            "Problemas emocionais",
            "Baixa libido",
            "Criatividade bloqueada",
            "Dependência",
            "Problemas reprodutivos"
        ],
        equilibrio: [
            "Dança",
            "Arte",
            "Terapia",
            "Exercícios pélvicos",
            "Práticas de prazer"
        ],
        practices: [
            {
                nome: "Dança Criativa",
                descricao: "Dance livremente ao som de música que você gosta",
                duracao: "15-20 minutos"
            },
            {
                nome: "Arte Terapia",
                descricao: "Pinte ou desenhe suas emoções",
                duracao: "20-30 minutos"
            }
        ]
    },
    raiz: {
        nome: "Chakra Raiz",
        descricao: "O chakra raiz está relacionado à sobrevivência, segurança e estabilidade.",
        caracteristicas: [
            "Estabilidade",
            "Segurança",
            "Força",
            "Determinação",
            "Conectividade"
        ],
        desequilibrio: [
            "Insegurança",
            "Problemas financeiros",
            "Ansiedade",
            "Problemas de coluna",
            "Medo"
        ],
        equilibrio: [
            "Exercícios físicos",
            "Contato com a terra",
            "Meditação",
            "Terapia",
            "Práticas de enraizamento"
        ],
        practices: [
            {
                nome: "Enraizamento",
                descricao: "Visualize raízes saindo dos seus pés",
                duracao: "10-15 minutos"
            },
            {
                nome: "Caminhada Consciente",
                descricao: "Caminhe descalço na natureza",
                duracao: "20-30 minutos"
            }
        ]
    }
};

// Função para carregar as informações dos chakras
function carregarChakras() {
    document.querySelectorAll('.chakra-item').forEach(item => {
        const chakra = item.dataset.chakra;
        const dados = chakras[chakra];

        // Atualizar detalhes
        const details = item.querySelector('.chakra-details');
        details.querySelector('.descricao').textContent = dados.descricao;

        const caracteristicas = details.querySelector('.caracteristicas ul');
        caracteristicas.innerHTML = dados.caracteristicas.map(c => `<li>${c}</li>`).join('');

        const desequilibrio = details.querySelector('.desequilibrio ul');
        desequilibrio.innerHTML = dados.desequilibrio.map(d => `<li>${d}</li>`).join('');

        const equilibrio = details.querySelector('.equilibrio ul');
        equilibrio.innerHTML = dados.equilibrio.map(e => `<li>${e}</li>`).join('');

        // Atualizar práticas recomendadas
        const practicesGrid = details.querySelector('.practices-grid');
        if (dados.practices) {
            practicesGrid.innerHTML = dados.practices.map(p => `
                <div class="practice-item">
                    <h6>${p.nome}</h6>
                    <p>${p.descricao}</p>
                    <small>Duração: ${p.duracao}</small>
                </div>
            `).join('');
        }
    });
}

// Carregar informações ao iniciar a página
document.addEventListener('DOMContentLoaded', carregarChakras);
</script>
@endsection
@endsection
