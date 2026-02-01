@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Editar plano" subtitle="Atualize as informacoes do plano.">
    <form class="form-grid" action="{{ route('planos.update', $plano) }}" method="post">
        @csrf
        @method('PUT')

        <x-field label="Nome" for="nome">
            <input id="nome" type="text" name="nome" class="form-input" value="{{ $plano->nome }}" required>
        </x-field>

        <x-field label="Descrição" for="descricao">
            <input id="descricao" type="text" name="descricao" class="form-input" value="{{ $plano->descricao }}" required>
        </x-field>

        <x-field label="Valor" for="valor">
            <input id="valor" type="number" name="valor" class="form-input" value="{{ $plano->valor }}" required>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Salvar</button>
            <a class="btn-secondary" href="{{ route('planos.index') }}">Voltar</a>
        </div>
    </form>
</x-section-card>

@endsection
