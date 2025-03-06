@extends('layouts.web')

@section('content')
<x-header-page title="💼 Criar Serviço" description="Cadastre um serviço esotérico e conecte-se com interessados." />
<section class="container ">
    <div class="p-4 rounded shadow-sm bg-light">
        <form action="{{ route('website.service.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <!-- Título do Serviço -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📌 Título do Serviço</label>
                    <input type="text" name="title" class="form-control" placeholder="Ex: Leitura de Tarô" required>
                </div>

                <!-- Tipo de Serviço -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📍 Tipo</label>
                    <select name="type" class="form-select" required id="type">
                        <option value="presencial">Presencial</option>
                        <option value="online">Online</option>
                    </select>
                </div>

                <!-- Cidade -->
                <!-- Estado -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🗺️ Estado</label>
                    <input list="stateList" name="state" id="state" class="form-control"
                        placeholder="Digite ou selecione um estado" required>
                    <datalist id="stateList">
                        <!-- Os estados serão carregados dinamicamente via JS -->
                    </datalist>
                </div>

                <!-- Cidade -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🏙️ Cidade</label>
                    <input list="cityList" name="city" id="city" class="form-control"
                        placeholder="Digite ou selecione uma cidade" required>
                    <datalist id="cityList">
                        <!-- As cidades serão carregadas com base no estado selecionado -->
                    </datalist>
                </div>


                <!-- Preço -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">💰 Preço</label>
                    <input type="text" name="price" class="form-control"
                        placeholder="Digite o valor ou deixe em branco para 'A combinar'">
                </div>

                <!-- Contato -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📞 Contato</label>
                    <input type="text" name="contact_info" class="form-control" placeholder="Ex: WhatsApp, E-mail"
                        required>
                </div>

                <!-- Imagem do Serviço -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">📸 Imagem do Serviço</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <!-- Descrição -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">📝 Descrição</label>
                    <textarea name="description" class="form-control" rows="3"
                        placeholder="Descreva o serviço..."></textarea>
                </div>

                <!-- Botões -->
                <div class="mt-3 text-center">
                    <button type="submit" class="px-4 btn btn-success">💾 Salvar</button>
                    <a href="{{ route('website.service.index') }}" class="px-4 btn btn-secondary">❌ Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</section>
@stop

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let estados = {}; // Objeto para mapear nome -> sigla

        // 🚀 Buscar todos os estados
        fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            .then(response => response.json())
            .then(data => {
                let stateList = document.getElementById('stateList');
                
                data.forEach(state => {
                    estados[state.nome] = state.sigla; // Mapeia Nome -> Sigla
                    let option = document.createElement('option');
                    option.value = state.nome; // Exibir o nome no datalist
                    option.setAttribute('data-uf', state.sigla); // Salva a sigla como atributo
                    stateList.appendChild(option);
                });
            });

        // 🚀 Quando um estado for selecionado, buscar cidades
        document.getElementById('state').addEventListener('input', function () {
            let stateName = this.value;
            let stateUF = estados[stateName]; // Obter sigla com base no nome

            if (!stateUF) {
                console.log("Estado inválido:", stateName);
                return;
            }

            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${stateUF}/municipios`)
                .then(response => response.json())
                .then(data => {
                    let cityList = document.getElementById('cityList');
                    cityList.innerHTML = ''; // Limpa cidades anteriores
                    data.forEach(city => {
                        let option = document.createElement('option');
                        option.value = city.nome; // Adiciona nome da cidade
                        cityList.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro ao carregar cidades:', error));
            });

        // 🚀 Quando o type for online, remove o campo de cidade e estado
        document.getElementById('type').addEventListener('change', function () {
            let type = this.value;
            let stateInput = document.getElementById('state');
            let cityInput = document.getElementById('city');

            if (type === 'online') {
                stateInput.value = '';
                cityInput.value = '';
                stateInput.disabled = true;
                cityInput.disabled = true;
            } else {
                stateInput.disabled = false;
                cityInput.disabled = false;
            }
        });
    });
</script>


@stop
