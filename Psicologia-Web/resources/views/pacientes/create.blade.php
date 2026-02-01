@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Novo paciente" subtitle="Cadastre um paciente e vincule ao psic?logo e plano.">
    @if ($errors->any())
        <div class="alert alert-error">
            <div>Corrija os campos destacados.</div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form-grid" action="{{ route('pacientes.store') }}" method="post">
        @csrf

        <div class="form-row">
            <x-field label="Nome" for="name">
                <input id="name" type="text" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>

            <x-field label="E-mail" for="email">
                <input id="email" type="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Senha" for="password">
                <input id="password" type="password" name="password" class="form-input @error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>

            <x-field label="CPF" for="cpf">
                <input id="cpf" type="text" name="cpf" class="form-input @error('cpf') is-invalid @enderror" value="{{ old('cpf') }}">
                @error('cpf')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Telefone" for="telefone">
                <input id="telefone" type="text" name="telefone" class="form-input @error('telefone') is-invalid @enderror" value="{{ old('telefone') }}">
                @error('telefone')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>

            <x-field label="Endere?o" for="endereco">
                <input id="endereco" type="text" name="endereco" class="form-input @error('endereco') is-invalid @enderror" value="{{ old('endereco') }}">
                @error('endereco')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Cidade" for="cidade">
                <input id="cidade" type="text" name="cidade" class="form-input @error('cidade') is-invalid @enderror" value="{{ old('cidade') }}">
                @error('cidade')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>

            <x-field label="Estado" for="estado">
                <input id="estado" type="text" name="estado" class="form-input @error('estado') is-invalid @enderror" value="{{ old('estado') }}">
                @error('estado')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Status" for="status">
                <select id="status" name="status" class="form-input @error('status') is-invalid @enderror">
                    <option value="ativo" @selected(old('status') === 'ativo')>Em atendimento</option>
                    <option value="alta" @selected(old('status') === 'alta')>De alta</option>
                    <option value="inativo" @selected(old('status') === 'inativo')>Desist?ncia</option>
                </select>
                @error('status')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </x-field>

            @if (auth()->user()->rules_id === 2)
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            @elseif (auth()->user()->rules_id === 1 || auth()->user()->rules_id === 3)
                <x-field label="Psic?logo" for="user_id">
                    <select id="user_id" name="user_id" class="form-input @error('user_id') is-invalid @enderror" required>
                        @foreach ($psicologos as $index => $psicologo)
                            <option value="{{ $psicologo->id }}" @selected((int) old('user_id', $index === 0 ? $psicologo->id : null) === $psicologo->id)>
                                {{ $psicologo->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </x-field>
            @endif
        </div>

        <x-field label="Plano" for="planos_id">
            <select id="planos_id" name="planos_id" class="form-input @error('planos_id') is-invalid @enderror">
                @foreach ($planos as $index => $plano)
                    <option value="{{ $plano->id }}" @selected((int) old('planos_id', $index === 0 ? $plano->id : null) === $plano->id)>
                        {{ $plano->nome }}
                    </option>
                @endforeach
            </select>
            @error('planos_id')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cadastrar</button>
        </div>
    </form>
</x-section-card>

@endsection
