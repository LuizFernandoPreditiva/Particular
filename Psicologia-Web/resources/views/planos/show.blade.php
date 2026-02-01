@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Plano" subtitle="Detalhes do plano.">
    <div class="info-list">
        <div><strong>Nome:</strong> {{ $plano->nome }}</div>
        <div><strong>Descrição:</strong> {{ $plano->descricao }}</div>
        <div><strong>Valor:</strong> {{ $plano->valor }}</div>
    </div>

    <div class="form-actions">
        <a class="btn-primary" href="{{ route('planos.edit', $plano->id) }}">Alterar</a>
        <form action="{{ route('planos.destroy', $plano) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Deletar</button>
        </form>
    </div>
</x-section-card>

@endsection
