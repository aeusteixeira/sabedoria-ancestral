@extends('layouts.web')

@section('content')
<section class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="border-0 shadow-sm card">
                <div class="card-body">
                    <div class="mb-4 text-center">
                        <h2 class="mb-2 fw-bold">Editar Perfil</h2>
                        <p class="text-muted">Atualize suas informações pessoais</p>
                    </div>

                    <form action="{{ route('website.profile.update', $user->username) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Foto do Perfil -->
                        <div class="mb-4 text-center">
                            <img src="{{ $user->profile_image }}" class="mb-3 rounded-circle" width="150" height="150"
                                alt="Foto de {{ $user->name }}">
                            <p class="text-muted small">
                                <i class="fas fa-info-circle me-1"></i>
                                Sua foto de perfil é gerenciada pelo Gravatar.
                                <a href="https://gravatar.com" target="_blank" class="text-primary">Clique aqui para alterá-la</a>
                            </p>
                        </div>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Nome de Usuário</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="mb-3">
                            <label for="bio" class="form-label">Biografia</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" rows="3">{{ old('description', $user->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="gap-2 d-flex justify-content-end">
                            <a href="{{ route('website.profile.index', $user->username) }}" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
