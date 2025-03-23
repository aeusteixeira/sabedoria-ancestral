@extends('layouts.web')

@section('content')
<x-header-page title="🔮 Editar Alquimia"
    description="Atualize as informações da alquimia cadastrada no sistema." />
<section class="container">
    <div class="p-4 rounded shadow-sm bg-light">
        <form action="{{ route('website.alchemy.update', ['alchemy' => $alchemy->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Nome da Alquimia -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🔮 Nome da Alquimia</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $alchemy->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagem da Alquimia -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🖼️ Imagem Representativa</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @if($alchemy->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $alchemy->image) }}" alt="Imagem da Alquimia" class="img-thumbnail" width="150">
                        </div>
                    @endif
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tipo de Alquimia -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🧪 Tipo de Alquimia</label>
                    <select name="alchemy_type_id" class="form-select @error('alchemy_type_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach ($alchemyTypes as $type)
                        <option value="{{ $type->id }}" {{ old('alchemy_type_id', $alchemy->alchemy_type_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->symbol }} {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('alchemy_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fase da Lua -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🌙 Fase da Lua</label>
                    <select name="moon_id" class="form-select @error('moon_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach ($moons as $moon)
                        <option value="{{ $moon->id }}" {{ old('moon_id', $alchemy->moon_id) == $moon->id ? 'selected' : '' }}>
                            {{ $moon->symbol }} {{ $moon->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('moon_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Melhor Dia -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📅 Melhor Dia</label>
                    <select name="day_of_week_id" class="form-select @error('day_of_week_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach ($days as $day)
                        <option value="{{ $day->id }}" {{ old('day_of_week_id', $alchemy->day_of_week_id) == $day->id ? 'selected' : '' }}>
                            {{ $day->symbol }} {{ $day->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('day_of_week_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Melhor Hora -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">⏳ Melhor Hora</label>
                    <select name="hour_id" class="form-select @error('hour_id') is-invalid @enderror">
                        <option value="">Selecione...</option>
                        @foreach ($hours as $hour)
                        <option value="{{ $hour->id }}" {{ old('hour_id', $alchemy->hour_id) == $hour->id ? 'selected' : '' }}>
                            {{ $hour->symbol }} {{ $hour->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('hour_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Ervas Associadas -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">🌿 Ervas Utilizadas</label>
                    <div class="row">
                        @foreach ($herbs as $herb)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="herbs[]" value="{{ $herb->id }}"
                                    id="herb-{{ $herb->id }}"
                                    {{ in_array($herb->id, old('herbs', $alchemy->herbs->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label" for="herb-{{ $herb->id }}">{{ $herb->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Campos de Texto -->
                @php
                    $fields = [
                        'description' => '📝 Descrição',
                        'preparation_method' => '🛠️ Método de Preparo',
                        'precautions' => '⚠️ Precauções'
                    ];
                @endphp

                @foreach($fields as $field => $label)
                <div class="col-md-12">
                    <label class="form-label fw-semibold">{{ $label }}</label>
                    <textarea name="{{ $field }}" class="form-control editor @error($field) is-invalid @enderror" rows="3">{{ old($field, $alchemy->$field) }}</textarea>
                    @error($field)
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach

                <!-- Botões -->
                <div class="mt-3 text-center">
                    <button type="submit" class="px-4 btn btn-success">💾 Atualizar</button>
                    <a href="{{ route('website.alchemy.index') }}" class="px-4 btn btn-secondary">❌ Cancelar</a>
