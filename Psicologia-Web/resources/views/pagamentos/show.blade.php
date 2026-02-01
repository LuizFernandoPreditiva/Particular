@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Pagamento" subtitle="Detalhes do pagamento.">
    <div class="info-list">
        <div><strong>Paciente:</strong> {{ $pagamento->paciente->name }}</div>
        <div><strong>Descrição:</strong> {{ $pagamento->descricao }}</div>
        <div><strong>Forma:</strong> {{ $pagamento->forma }}</div>
        <div><strong>Parcelas:</strong> {{ $pagamento->parcelas }}</div>
        <div><strong>Valor:</strong> {{ $pagamento->valor }}</div>
    </div>

    <div class="form-actions">
        <a class="btn-primary" href="{{ route('pagamentos.edit', $pagamento->id) }}">Alterar</a>
        <form action="{{ route('pagamentos.destroy', $pagamento) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Deletar</button>
        </form>
    </div>
</x-section-card>

@endsection
