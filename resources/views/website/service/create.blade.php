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
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           placeholder="Ex: Leitura de Tarô" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tipo de Serviço -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📍 Tipo</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required id="type">
                        <option value="presencial" {{ old('type') == 'presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="online" {{ old('type') == 'online' ? 'selected' : '' }}>Online</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🗺️ Estado</label>
                    <input list="stateList" name="state" id="state" class="form-control @error('state') is-invalid @enderror"
                        placeholder="Digite ou selecione um estado" value="{{ old('state') }}" required>
                    <datalist id="stateList"></datalist>
                    @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Cidade -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🏙️ Cidade</label>
                    <input list="cityList" name="city" id="city" class="form-control @error('city') is-invalid @enderror"
                        placeholder="Digite ou selecione uma cidade" value="{{ old('city') }}" required>
                    <datalist id="cityList"></datalist>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Preço -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">💰 Preço</label>
                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                        placeholder="Digite o valor ou deixe em branco para 'A combinar'" value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">📸 Imagem do Serviço</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tipo de Contato -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📞 Tipo de Contato</label>
                    <select name="contact_type" class="form-select" required id="contact_type">
                        <option value="whatsapp" {{ old('contact_type', $service->contact_type ?? '') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                        <option value="telefone" {{ old('contact_type', $service->contact_type ?? '') == 'telefone' ? 'selected' : '' }}>Telefone</option>
                        <option value="email" {{ old('contact_type', $service->contact_type ?? '') == 'email' ? 'selected' : '' }}>E-mail</option>
                        <option value="instagram" {{ old('contact_type', $service->contact_type ?? '') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                        <option value="telegram" {{ old('contact_type', $service->contact_type ?? '') == 'telegram' ? 'selected' : '' }}>Telegram</option>
                        <option value="facebook" {{ old('contact_type', $service->contact_type ?? '') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                        <option value="link" {{ old('contact_type', $service->contact_type ?? '') == 'link' ? 'selected' : '' }}>Link</option>
                    </select>
                </div>


                <!-- Contato -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📞 Contato</label>
                    <input type="text" name="contact_info" id="contact_info" class="form-control"
                        placeholder="Digite o número ou link" value="{{ old('contact_info', $service->contact_info ?? '') }}" required>
                </div>

                <!-- Imagem do Serviço -->


                <!-- Descrição -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">📝 Descrição</label>
                    <textarea name="description" class="form-control editor @error('description') is-invalid @enderror"
                        rows="3" placeholder="Descreva o serviço...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Demais erros -->
                @if ($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

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
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.editor').forEach((element) => {
            ClassicEditor
                .create(element)
                .then(editor => {
                    editor.ui.view.editable.element.style.height = '200px';
                    editor.ui.view.editable.element.style.maxHeight = '200px';
                })
                .catch(error => console.error(error));
        });
    });
</script>
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
<script>
    document.getElementById("contact_type").addEventListener("change", function () {
        let contactInput = document.getElementById("contact_info");
        if (this.value === "whatsapp") {
            contactInput.placeholder = "Digite o número do WhatsApp (com DDD)";
        } else if (this.value === "telefone") {
            contactInput.placeholder = "Digite o número do telefone (com DDD)";
        } else if (this.value === "email") {
            contactInput.placeholder = "Digite o e-mail";
        } else if (this.value === "instagram") {
            contactInput.placeholder = "Digite o link do Instagram";
        } else if (this.value === "telegram") {
            contactInput.placeholder = "Digite o link do Telegram";
        } else if (this.value === "facebook") {
            contactInput.placeholder = "Digite o link do Facebook";
        } else if (this.value === "link") {
            contactInput.placeholder = "Digite o link";
        }else{
            contactInput.placeholder = "Digite o número ou link";
        }
    });
</script>
@stop

