@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Novo plano" subtitle="Cadastre um novo plano de atendimento.">
    <form class="form-grid" action="{{ route('planos.store') }}" method="post">
        @csrf

        <x-field label="Nome" for="nome">
            <input id="nome" type="text" name="nome" class="form-input" required>
        </x-field>

        <x-field label="Descrição" for="descricao">
            <input id="descricao" type="text" name="descricao" class="form-input" required>
        </x-field>

        <x-field label="Valor" for="valor">
            <input id="valor" type="number" name="valor" class="form-input" required>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cadastrar</button>
            <a class="btn-secondary" href="{{ route('planos.index') }}">Voltar</a>
        </div>
    </form>
</x-section-card>

@endsection
