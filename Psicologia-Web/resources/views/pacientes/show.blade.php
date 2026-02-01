@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Paciente" subtitle="Detalhes do cadastro.">
    <div class="info-list">
        <div><strong>ID:</strong> {{ $paciente->id }}</div>
        <div><strong>Nome:</strong> {{ $paciente->name }}</div>
        <div><strong>CPF:</strong> {{ $paciente->cpf }}</div>
        <div><strong>Telefone:</strong> {{ $paciente->telefone }}</div>
        <div><strong>Endereço:</strong> {{ $paciente->endereco }}</div>
        <div><strong>Cidade:</strong> {{ $paciente->cidade }}</div>
        <div><strong>Estado:</strong> {{ $paciente->estado }}</div>
        <div><strong>Psicólogo:</strong> {{ $paciente->psicologo ? $paciente->psicologo->name : 'Não informado' }}</div>
        <div><strong>Status:</strong> {{ $paciente->status }}</div>
        <div><strong>Plano:</strong> {{ $paciente->plano ? $paciente->plano->nome : 'Sem plano' }}</div>
        <div><strong>Atendimentos:</strong> {{ $paciente->atendimentos }}</div>
        <div><strong>Faltas:</strong> {{ $paciente->faltas }}</div>
        <div><strong>Saldo:</strong> {{ $paciente->saldo }}</div>
    </div>

    <form id="form-delete-{{ $paciente->id }}" action="{{ route('pacientes.destroy', $paciente) }}" method="post" class="form-actions">
        <a class="btn-primary" href="{{ route('pacientes.edit', $paciente->id) }}">Alterar</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-danger" onclick="confirmDelete({{ $paciente->id }})">Deletar</button>
        <a class="btn-secondary" href="{{ route('pagamentos.novo', ['id' => $paciente->id]) }}">Novo Pagamento</a>
        <a class="btn-secondary" href="{{ route('pagamentos.historico', $paciente) }}">Financeiro</a>
        <a class="btn-secondary" href="{{ route('atendimentos.registro', $paciente) }}">Atendimentos</a>
        <a class="btn-secondary" href="{{ route('atendimentos.create', ['user_id' => $paciente->id]) }}">Criar atendimento</a>
    </form>
</x-section-card>

@endsection

<script type="text/javascript" src="{{ asset('js/delete.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
