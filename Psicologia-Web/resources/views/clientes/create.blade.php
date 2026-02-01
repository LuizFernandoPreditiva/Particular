@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Novo cliente" subtitle="Cadastre um cliente e vincule ao psicologo e plano.">
    <form class="form-grid" action="{{ route('clientes.store') }}" method="post">
        @csrf

        <div class="form-row">
            <x-field label="Nome" for="nome">
                <input id="nome" type="text" name="nome" class="form-input" required>
            </x-field>

            <x-field label="CPF" for="cpf">
                <input id="cpf" type="text" name="cpf" class="form-input" required>
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Telefone" for="telefone">
                <input id="telefone" type="text" name="telefone" class="form-input" required>
            </x-field>

            <x-field label="Endereço" for="endereco">
                <input id="endereco" type="text" name="endereco" class="form-input" required>
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Cidade" for="cidade">
                <input id="cidade" type="text" name="cidade" class="form-input" required>
            </x-field>

            <x-field label="Estado" for="estado">
                <input id="estado" type="text" name="estado" class="form-input" required>
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Status" for="status">
                <select id="status" name="status" class="form-input">
                    <option value="ativo">Em atendimento</option>
                    <option value="alta">De alta</option>
                    <option value="inativo">Desistência</option>
                </select>
            </x-field>

            @if (auth()->user()->rules_id === 2)
                <input type="hidden" name="users_id" value="{{ auth()->id() }}">
            @elseif (auth()->user()->rules_id === 1 || auth()->user()->rules_id === 3)
                <x-field label="Psicólogo" for="users_id">
                    <select id="users_id" name="users_id" class="form-input" required>
                        @foreach ($psicologos as $index => $psicologo)
                            <option value="{{ $psicologo->id }}" {{ $index === 0 ? 'selected' : '' }}>
                                {{ $psicologo->name }}
                            </option>
                        @endforeach
                    </select>
                </x-field>
            @endif
        </div>

        <x-field label="Plano" for="planos_id">
            <select id="planos_id" name="planos_id" class="form-input">
                @foreach ($planos as $index => $plano)
                    <option value="{{ $plano->id }}" {{ $index === 0 ? 'selected' : '' }}>
                        {{ $plano->nome }}
                    </option>
                @endforeach
            </select>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cadastrar</button>
        </div>
    </form>
</x-section-card>

@endsection
