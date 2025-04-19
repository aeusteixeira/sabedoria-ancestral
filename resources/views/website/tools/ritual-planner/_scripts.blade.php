<!-- Scripts do Planejador de Rituais -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ritualForm');
    const calculateButton = document.getElementById('calculateButton');
    const resultContainer = document.getElementById('resultContainer');
    const token = document.querySelector('meta[name="csrf-token"]').content;

    const loadingMessages = [
        'Analisando as fases da lua...',
        'Consultando as influências planetárias...',
        'Verificando as energias do dia...',
        'Alinhando com as forças elementais...',
        'Recebendo orientação dos astros...',
        'Calculando o melhor momento...',
        'Sintonizando com as energias cósmicas...',
        'Harmonizando as vibrações místicas...'
    ];

    let currentMessageIndex = 0;
    let loadingInterval;

    function showLoading() {
        const loadingContainer = document.getElementById('loadingContainer');
        const loadingMessage = document.getElementById('loadingMessage');
        loadingContainer.style.display = 'block';
        resultContainer.style.display = 'none';

        currentMessageIndex = 0;
        loadingMessage.textContent = loadingMessages[0];
        loadingMessage.classList.add('fade-message');

        loadingInterval = setInterval(() => {
            currentMessageIndex = (currentMessageIndex + 1) % loadingMessages.length;
            loadingMessage.textContent = loadingMessages[currentMessageIndex];
        }, 4000);
    }

    function hideLoading() {
        const loadingContainer = document.getElementById('loadingContainer');
        loadingContainer.style.display = 'none';
        clearInterval(loadingInterval);
    }

    function formatDate(dateString) {
        if (!dateString) return null;
        const date = new Date(dateString + 'T00:00:00'); // Adiciona horário para evitar problemas de timezone
        if (isNaN(date.getTime())) return null; // Verifica se a data é válida
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    if (calculateButton) {
        calculateButton.addEventListener('click', async function(e) {
            e.preventDefault();
            e.stopPropagation();

            try {
                const intention = document.getElementById('intention');
                const date = document.getElementById('date');

                if (!intention.value) {
                    intention.classList.add('is-invalid');
                    alert('Por favor, selecione sua intenção.');
                    return;
                }

                intention.classList.remove('is-invalid');

                // Envia a data apenas se foi selecionada e é válida
                const formattedDate = date.value ? formatDate(date.value) : null;
                if (date.value && !formattedDate) {
                    date.classList.add('is-invalid');
                    alert('Por favor, selecione uma data válida.');
                    return;
                }

                const data = {
                    intention: intention.value,
                    date: formattedDate
                };

                showLoading();

                const response = await fetch('{{ route("website.ritual-planner.calculate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const responseData = await response.json();

                if (!responseData.success) {
                    throw new Error(responseData.message || 'Erro ao calcular o ritual');
                }

                updateResults(responseData.data);
                resultContainer.style.display = 'block';
                resultContainer.scrollIntoView({ behavior: 'smooth' });

            } catch (error) {
                console.error('Erro:', error);
                hideLoading();
                alert(error.message || 'Ocorreu um erro ao processar sua solicitação. Por favor, tente novamente.');
                resultContainer.style.display = 'none';
            } finally {
                hideLoading();
            }
        });
    }

    function updateResults(data) {
        try {
            // Verifica se os dados necessários existem
            if (!data || !data.melhor_data) {
                throw new Error('Dados incompletos recebidos do servidor');
            }

            // Atualiza informações da melhor data
            document.getElementById('bestHour').textContent = data.recomendacoes?.hora_planetaria || '-';
            document.getElementById('bestDate').textContent = data.melhor_data.data || '-';
            document.getElementById('bestMoonPhase').textContent = data.melhor_data.fase_lunar || '-';
            document.getElementById('bestPlanetaryHour').textContent = data.recomendacoes?.hora_planetaria || '-';
            document.getElementById('bestMagicalDirection').textContent = data.recomendacoes?.direcao || '-';

            // Atualiza informações da data selecionada (se houver)
            const selectedDateContainer = document.getElementById('selectedDateContainer');
            const dateInput = document.getElementById('date');

            if (dateInput.value && data.data_selecionada && data.data_selecionada.data !== data.melhor_data.data) {
                document.getElementById('selectedHour').textContent = data.data_selecionada.hora_planetaria || '-';
                document.getElementById('selectedDate').textContent = data.data_selecionada.data || '-';
                document.getElementById('selectedMoonPhase').textContent = data.data_selecionada.fase_lunar || '-';
                document.getElementById('selectedPlanetaryHour').textContent = data.data_selecionada.hora_planetaria || '-';

                // Atualiza o alerta da fase lunar
                const moonPhaseAlert = document.getElementById('moonPhaseAlert');
                const moonPhaseMessage = document.getElementById('moonPhaseMessage');
                moonPhaseAlert.className = 'alert alert-info mt-3 mb-0';
                moonPhaseMessage.innerHTML = `<i class="fas fa-info-circle"></i> ${data.data_selecionada.mensagem || ''}`;
                moonPhaseAlert.style.display = 'block';
                selectedDateContainer.style.display = 'block';
            } else {
                selectedDateContainer.style.display = 'none';
            }

            // Tradução dos dias da semana
            const diasSemana = {
                'Monday': 'Segunda-feira',
                'Tuesday': 'Terça-feira',
                'Wednesday': 'Quarta-feira',
                'Thursday': 'Quinta-feira',
                'Friday': 'Sexta-feira',
                'Saturday': 'Sábado',
                'Sunday': 'Domingo'
            };

            // Mapeamento de planetas regentes e suas energias por dia
            const planetasRegentes = {
                'Monday': {
                    planeta: 'Lua',
                    cores: 'Branco, Prata, Lilás'
                },
                'Tuesday': {
                    planeta: 'Marte',
                    cores: 'Vermelho, Laranja'
                },
                'Wednesday': {
                    planeta: 'Mercúrio',
                    cores: 'Amarelo, Cinza'
                },
                'Thursday': {
                    planeta: 'Júpiter',
                    cores: 'Azul, Roxo, Dourado'
                },
                'Friday': {
                    planeta: 'Vênus',
                    cores: 'Verde, Rosa'
                },
                'Saturday': {
                    planeta: 'Saturno',
                    cores: 'Preto, Marrom, Roxo escuro'
                },
                'Sunday': {
                    planeta: 'Sol',
                    cores: 'Dourado, Amarelo, Laranja'
                }
            };

            // Função para obter o dia da semana a partir de uma data
            function getDiaSemana(dataString) {
                if (!dataString) return '-';
                const [dia, mes, ano] = dataString.split('/');
                const data = new Date(Date.UTC(ano, mes - 1, dia));
                const dias = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                return dias[data.getUTCDay()];
            }

            // Usa a data da melhor data para determinar o dia da semana
            const diaSemana = getDiaSemana(data.melhor_data.data);
            const planetaInfo = planetasRegentes[diaSemana] || { planeta: '-', cores: '-' };

            // Atualiza informações místicas
            document.getElementById('weekDay').textContent = diasSemana[diaSemana] || diaSemana;
            document.getElementById('weekDayPlanet').textContent = planetaInfo.planeta;
            document.getElementById('dayColor').textContent = planetaInfo.cores;
            document.getElementById('dayNumber').textContent = data.informacoes_misticas?.numero_dia || '-';

            document.getElementById('sunSign').textContent = data.informacoes_misticas?.sol || '-';
            document.getElementById('moonSign').textContent = data.informacoes_misticas?.lua || '-';
            document.getElementById('ascendant').textContent = data.informacoes_misticas?.ascendente || '-';

            // Atualiza materiais recomendados
            const herbsContainer = document.getElementById('recommendedHerbs');
            herbsContainer.innerHTML = (data.materiais?.ervas || []).map(erva => `
                <div class="recommended-item" title="${erva.description || ''}">
                    <i class="fas fa-leaf"></i> ${erva.name || '-'}
                    <small class="d-block text-muted">${erva.magical_uses || ''}</small>
                </div>
            `).join('') || '<div class="text-muted">Nenhuma erva recomendada</div>';

            const stonesContainer = document.getElementById('recommendedStones');
            stonesContainer.innerHTML = (data.materiais?.cristais || []).map(cristal => `
                <div class="recommended-item" title="${cristal.description || ''}">
                    <i class="fas fa-gem"></i> ${cristal.name || '-'}
                    <small class="d-block text-muted">${cristal.properties || ''}</small>
                </div>
            `).join('') || '<div class="text-muted">Nenhum cristal recomendado</div>';

            // Atualiza os passos do ritual
            const passosRitual = data.passos_ritual || {};
            document.getElementById('preparationSteps').innerHTML = createStepsList(passosRitual.preparacao?.passos || []);
            document.getElementById('ritualSteps').innerHTML = createStepsList(passosRitual.ritual?.passos || []);
            document.getElementById('postRitualSteps').innerHTML = createStepsList(passosRitual.pos_ritual?.passos || []);

            // Atualiza o Visualizador Lunar
            const visualizadorLunar = data.visualizador_lunar;
            if (visualizadorLunar) {
                // Atualiza informações básicas
                document.getElementById('moonIcon').textContent = visualizadorLunar.icone || '-';
                document.getElementById('moonPhaseName').textContent = visualizadorLunar.fase_atual || '-';
                document.getElementById('moonIllumination').textContent = visualizadorLunar.iluminacao || '-';
                document.getElementById('moonAge').textContent = visualizadorLunar.idade_lua || '-';

                // Atualiza descrição
                document.getElementById('moonDescription').textContent = visualizadorLunar.descricao || '-';

                // Atualiza influências
                const influencias = visualizadorLunar.influencias || {};
                document.getElementById('moonEnergy').textContent = influencias.energia || '-';
                document.getElementById('moonElements').textContent = influencias.elementos || '-';
                document.getElementById('moonChakras').textContent = influencias.chakras || '-';
                document.getElementById('moonEmotions').textContent = influencias.emocoes || '-';

                // Atualiza recomendações
                const recomendacoes = visualizadorLunar.recomendacoes || {};

                // Atualiza rituais
                document.getElementById('moonRituals').innerHTML = createListItems(recomendacoes.rituais);

                // Atualiza cristais
                document.getElementById('moonCrystals').innerHTML = createListItems(recomendacoes.cristais);

                // Atualiza ervas
                document.getElementById('moonHerbs').innerHTML = createListItems(recomendacoes.ervas);

                // Atualiza práticas
                document.getElementById('moonPractices').innerHTML = createListItems(recomendacoes.praticas);
            }

        } catch (error) {
            console.error('Erro ao atualizar resultados:', error);
            alert('Ocorreu um erro ao exibir os resultados. Por favor, tente novamente.');
            resultContainer.style.display = 'none';
        }
    }

    function createStepsList(steps) {
        return `<ul class="list-unstyled mb-0">
            ${steps.map(step => `
                <li class="mb-2">
                    ${step}
                </li>
            `).join('')}
        </ul>`;
    }

    // Função auxiliar para criar itens de lista
    function createListItems(items) {
        if (!items || !Array.isArray(items) || items.length === 0) {
            return '<li>-</li>';
        }
        return items.map(item => `<li><i class="fas fa-circle me-2"></i>${item}</li>`).join('');
    }

    // Manipulador para salvar o ritual
    const saveButton = document.getElementById('saveRitual');
    if (saveButton) {
        saveButton.onclick = async function(e) {
            e.preventDefault();
            console.log('Salvando ritual');

            try {
                const formData = new FormData(form);
                const requestData = {
                    title: formData.get('intention'),
                    intention: formData.get('intention'),
                    date: formatDate(formData.get('date'))
                };

                const response = await fetch('/tools/ritual-planner/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                });

                const data = await response.json();

                if (data.error) {
                    throw new Error(data.message);
                }

                alert('Ritual salvo com sucesso!');

            } catch (error) {
                console.error('Erro:', error);
                alert(error.message || 'Erro ao salvar o ritual');
            }
        };
    }

    // Manipulador para imprimir o ritual
    const printButton = document.getElementById('printRitual');
    if (printButton) {
        printButton.onclick = function(e) {
            e.preventDefault();
            window.print();
        };
    }
});
</script>
