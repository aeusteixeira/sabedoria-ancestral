@extends('layouts.web')

@section('content')
<x-header-page
    title="🌿 Editar Erva"
    description="Atualize as informações da erva cadastrada no sistema."
/>
<section class="container">
    <div class="p-4 rounded shadow-sm bg-light">
        <form action="{{ route('website.herb.update', $herb->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Nome da Erva -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nome da Erva</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $herb->name) }}" required>
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
                    @if($herb->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $herb->image) }}" alt="Imagem da Erva" class="img-thumbnail" width="150">
                        </div>
                    @endif
                </div>

                <!-- Temperatura -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">🌡️ Temperatura</label>
                    <select name="temperature_regent_id" class="form-select @error('temperature_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach ($temperatures as $temperature)
                            <option value="{{ $temperature->id }}" {{ old('temperature_id', $herb->temperature_regent_id) == $temperature->id ? 'selected' : '' }}>
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
                            <option value="{{ $element->id }}" {{ old('element_id', $herb->element_regent_id) == $element->id ? 'selected' : '' }}>
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
                            <option value="{{ $planet->id }}" {{ old('planet_id', $herb->planet_regent_id) == $planet->id ? 'selected' : '' }}>
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
                                           {{ in_array($chakra->id, old('chakras', $herb->chakras->pluck('id')->toArray())) ? 'checked' : '' }}>
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

                <!-- Campos de Texto -->
                @php
                    $fields = [
                        'description' => '📝 Descrição',
                        'history_origin' => '📜 História e Origem',
                        'magical_uses' => '🔮 Usos Mágicos',
                        'biological_uses' => '🌱 Usos Biológicos',
                        'precautions' => '⚠️ Precauções'
                    ];
                @endphp

                @foreach($fields as $field => $label)
                <div class="col-md-6">
                    <label class="form-label fw-semibold">{{ $label }}</label>
                    <textarea name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" rows="3">{{ old($field, $herb->$field) }}</textarea>
                    @error($field)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach

                <!-- Botões -->
                <div class="mt-3 text-center">
                    <button type="submit" class="px-4 btn btn-success">💾 Atualizar</button>
                    <a href="{{ route('website.herb.index') }}" class="px-4 btn btn-secondary">❌ Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</section>
@stop
