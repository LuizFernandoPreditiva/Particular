@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Editar cliente" subtitle="Atualize os dados do cliente selecionado.">
    <form class="form-grid" action="{{ route('clientes.update', $cliente) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-row">
            <x-field label="Nome" for="nome">
                <input id="nome" type="text" name="nome" class="form-input" value="{{ $cliente->nome }}" required>
            </x-field>

            <x-field label="CPF" for="cpf">
                <input id="cpf" type="text" name="cpf" class="form-input" value="{{ $cliente->cpf }}" required>
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Telefone" for="telefone">
                <input id="telefone" type="text" name="telefone" class="form-input" value="{{ $cliente->telefone }}" required>
            </x-field>

            <x-field label="Endereço" for="endereco">
                <input id="endereco" type="text" name="endereco" class="form-input" value="{{ $cliente->endereco }}" required>
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Cidade" for="cidade">
                <input id="cidade" type="text" name="cidade" class="form-input" value="{{ $cliente->cidade }}" required>
            </x-field>

            <x-field label="Estado" for="estado">
                <input id="estado" type="text" name="estado" class="form-input" value="{{ $cliente->estado }}" required>
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Status" for="status">
                <select id="status" name="status" class="form-input">
                    <option value="ativo" @if ($cliente->status == 'ativo') selected @endif>Em atendimento</option>
                    <option value="alta" @if ($cliente->status == 'alta') selected @endif>De alta</option>
                    <option value="inativo" @if ($cliente->status == 'inativo') selected @endif>Desistência</option>
                </select>
            </x-field>

            <x-field label="Plano" for="plano_id">
                <select id="plano_id" name="plano_id" class="form-input" required>
                    @foreach ($planos as $plano)
                        <option value="{{ $plano->id }}" @if ($cliente->plano_id == $plano->id) selected @endif>
                            {{ $plano->nome }}
                        </option>
                    @endforeach
                </select>
            </x-field>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Salvar</button>
            <a class="btn-secondary" href="{{ route('clientes.index') }}">Voltar</a>
        </div>
    </form>
</x-section-card>

@endsection
