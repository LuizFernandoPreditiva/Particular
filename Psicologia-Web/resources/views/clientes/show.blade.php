@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Cliente" subtitle="Detalhes do cadastro.">
    <div class="info-list">
        <div><strong>ID:</strong> {{ $cliente->id }}</div>
        <div><strong>Nome:</strong> {{ $cliente->nome }}</div>
        <div><strong>CPF:</strong> {{ $cliente->cpf }}</div>
        <div><strong>Telefone:</strong> {{ $cliente->telefone }}</div>
        <div><strong>Endereço:</strong> {{ $cliente->endereco }}</div>
        <div><strong>Cidade:</strong> {{ $cliente->cidade }}</div>
        <div><strong>Estado:</strong> {{ $cliente->estado }}</div>
        <div><strong>Status:</strong> {{ $cliente->status }}</div>
        <div><strong>Plano:</strong> {{ $cliente->plano ? $cliente->plano->nome : 'Sem plano' }}</div>
        <div><strong>Atendimentos:</strong> {{ $cliente->atendimentos }}</div>
        <div><strong>Faltas:</strong> {{ $cliente->faltas }}</div>
        <div><strong>Saldo:</strong> {{ $cliente->saldo }}</div>
    </div>

    <form id="form-delete-{{ $cliente->id }}" action="{{ route('clientes.destroy', $cliente) }}" method="post" class="form-actions">
        <a class="btn-primary" href="{{ route('clientes.edit', $cliente->id) }}">Alterar</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-danger" onclick="confirmDelete({{ $cliente->id }})">Deletar</button>
        <a class="btn-secondary" href="{{ route('pagamentos.novo', ['id' => $cliente->id]) }}">Novo Pagamento</a>
        <a class="btn-secondary" href="{{ route('pagamentos.historico', $cliente) }}">Financeiro</a>
        <a class="btn-secondary" href="{{ route('atendimentos.registro', $cliente) }}">Atendimentos</a>
    </form>
</x-section-card>

@endsection

<script type="text/javascript" src="{{ asset('js/delete.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
