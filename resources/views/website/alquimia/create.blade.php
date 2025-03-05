@extends('layouts.web')



@section('content')
<x-header-page title="🔮 Cadastrar Nova Alquimia"
    description="Adicione uma nova alquimia ao sistema e compartilhe seu conhecimento com a comunidade." />
<section class="container ">
    <div class="p-4 rounded shadow-sm bg-light">
        <form action="{{ route('website.alchemy.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <!-- Nome da Alquimia -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🔮 Nome da Alquimia</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Ex: Poção da Lua" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Imagem da Alquimia -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🖼️ Imagem Representativa</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
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
                        <option value="{{ $type->id }}" {{ old('alchemy_type_id') == $type->id ? 'selected' : '' }}>
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
                        <option value="{{ $moon->id }}" {{ old('moon_id') == $moon->id ? 'selected' : '' }}>
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
                        <option value="{{ $day->id }}" {{ old('day_of_week_id') == $day->id ? 'selected' : '' }}>
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
                        <option value="{{ $hour->id }}" {{ old('hour_id') == $hour->id ? 'selected' : '' }}>
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
                                <input class="form-check-input @error('herbs') is-invalid @enderror" type="checkbox"
                                    name="herbs[]" value="{{ $herb->id }}" id="herb-{{ $herb->id }}"
                                    {{ is_array(old('herbs')) && in_array($herb->id, old('herbs')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="herb-{{ $herb->id }}">
                                    {{ $herb->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('herbs')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Pedras Associadas -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">💎 Pedras Utilizadas</label>
                    <div class="row">
                        @foreach ($stones as $stone)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input @error('stones') is-invalid @enderror" type="checkbox"
                                    name="stones[]" value="{{ $stone->id }}" id="stone-{{ $stone->id }}"
                                    {{ is_array(old('stones')) && in_array($stone->id, old('stones')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="stone-{{ $stone->id }}">
                                    {{ $stone->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('stones')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descrição -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">📝 Descrição</label>
                    <textarea name="description" class="form-control editor" rows="3"
                        placeholder="Descreva a alquimia e seus efeitos">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Método de Preparo -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">🛠️ Método de Preparo</label>
                    <textarea name="preparation_method" class="form-control editor" rows="3"
                        placeholder="Explique como preparar esta alquimia">{{ old('preparation_method') }}</textarea>
                    @error('preparation_method')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Precauções -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold text-danger">⚠️ Precauções</label>
                    <textarea name="precautions" class="form-control editor" rows="3"
                        placeholder="Liste precauções importantes">{{ old('precautions') }}</textarea>
                    @error('precautions')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Botões -->
                <div class="mt-3 text-center">
                    <button type="submit" class="px-4 btn btn-success">💾 Salvar</button>
                    <a href="{{ route('website.alchemy.index') }}" class="px-4 btn btn-secondary">❌ Cancelar</a>
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

@stop
