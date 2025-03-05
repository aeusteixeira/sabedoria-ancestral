@extends('layouts.web')



@section('content')
<x-header-page
    title="🌿 Cadastrar Nova Erva"
    description="Adicione uma nova erva ao sistema e compartilhe seu conhecimento com a comunidade."
/>
<section class="container ">
    <div class="p-4 rounded shadow-sm bg-light">
        <form action="{{ route('website.herb.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <!-- Nome da Erva -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nome da Erva</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Ex: Manjericão" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagem da Erva -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Imagem da Erva</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Temperatura -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">🌡️ Temperatura</label>
                    <select name="temperature_regent_id" class="form-select @error('temperature_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach ($temperatures as $temperature)
                            <option value="{{ $temperature->id }}" {{ old('temperature_id') == $temperature->id ? 'selected' : '' }}>
                                {{ $temperature->symbol }} {{ $temperature->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('temperature_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Elemento -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">🌍 Elemento</label>
                    <select name="element_regent_id" class="form-select @error('element_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach ($elements as $element)
                            <option value="{{ $element->id }}" {{ old('element_id') == $element->id ? 'selected' : '' }}>
                                {{ $element->symbol }} {{ $element->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('element_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Planeta -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">🪐 Planeta Regente</label>
                    <select name="planet_regent_id" class="form-select @error('planet_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach ($planets as $planet)
                            <option value="{{ $planet->id }}" {{ old('planet_id') == $planet->id ? 'selected' : '' }}>
                                {{ $planet->symbol }} {{ $planet->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('planet_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Chakras (Checkboxes) -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">🌀 Chakras Associados</label>
                    <div class="row">
                        @foreach ($chakras as $chakra)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('chakras') is-invalid @enderror"
                                           type="checkbox" name="chakras[]" value="{{ $chakra->id }}"
                                           id="chakra-{{ $chakra->id }}"
                                           {{ is_array(old('chakras')) && in_array($chakra->id, old('chakras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="chakra-{{ $chakra->id }}">
                                        <span class="px-3 py-2 badge" style="background-color: {{ $chakra->color_background }}; color: {{ $chakra->color_text }}">
                                            {{ $chakra->name }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('chakras')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descrição -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">📝 Descrição</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                              placeholder="Descreva as propriedades e usos mágicos">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- História e Origem -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📜 História e Origem</label>
                    <textarea name="history_origin" class="form-control @error('history_origin') is-invalid @enderror" rows="3"
                              placeholder="Conte a origem da erva">{{ old('history_origin') }}</textarea>
                    @error('history_origin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Usos Mágicos -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🔮 Usos Mágicos</label>
                    <textarea name="magical_uses" class="form-control @error('magical_uses') is-invalid @enderror" rows="3"
                              placeholder="Como essa erva pode ser usada magicamente?">{{ old('magical_uses') }}</textarea>
                    @error('magical_uses')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Usos Biológicos -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🌱 Usos Biológicos</label>
                    <textarea name="biological_uses" class="form-control @error('biological_uses') is-invalid @enderror" rows="3"
                              placeholder="Propriedades curativas e benefícios">{{ old('biological_uses') }}</textarea>
                    @error('biological_uses')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Precauções -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-danger">⚠️ Precauções</label>
                    <textarea name="precautions" class="form-control @error('precautions') is-invalid @enderror" rows="3"
                              placeholder="Algum cuidado necessário ao usar essa erva?">{{ old('precautions') }}</textarea>
                    @error('precautions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mostra os demais erros -->
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
                    <a href="{{ route('website.herb.index') }}" class="px-4 btn btn-secondary">❌ Cancelar</a>
                </div>
            </div>
        </form>

    </div>
</section>
@stop
