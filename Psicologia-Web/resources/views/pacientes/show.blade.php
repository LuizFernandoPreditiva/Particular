@extends('layouts.principalLogado')

@section('main')

    <div class="exibir-cliente">
        <h1>Paciente:</h1>
        <p>
            ID: {{$paciente->id}}<br>
            Nome: {{$paciente->name}}<br>
            CPF: {{$paciente->cpf}}<br>
            Telefone: {{$paciente->telefone}}<br>
            Endereco: {{$paciente->endereco}}<br>
            Cidade: {{$paciente->cidade}}<br>
            Estado: {{$paciente->estado}}<br>
            Psicologo: {{ $paciente->psicologo ? $paciente->psicologo->name : 'Nao informado' }}<br>
            status: {{$paciente->status}}<br>
            Plano: {{ $paciente->plano ? $paciente->plano->nome : 'Sem plano' }}<br>
            Atendimentos: {{$paciente->atendimentos}}<br>
            Faltas: {{$paciente->faltas}}<br>
            Saldo: {{$paciente->saldo}}<br>
        </p>

        <form id="form-delete-{{ $paciente->id }}" action="{{route('pacientes.destroy', $paciente)}}" method="post">
            <a class="btn btn-primary" href="{{route('pacientes.edit', $paciente->id )}}" role="button">Alterar</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary" onclick="confirmDelete({{ $paciente->id }})">Deletar</button>
            <a class="btn btn-primary" href="{{route('pagamentos.novo', ['id' => $paciente->id ] )}}" role="button">Novo Pagamento</a>
            <a class="btn btn-primary" href="{{route('pagamentos.historico', $paciente )}}" role="button">Financeiro</a>
            <a class="btn btn-primary" href="{{route('atendimentos.registro', $paciente )}}" role="button">Atendimentos</a>
            <a class="btn btn-primary" href="{{route('atendimentos.create', ['user_id' => $paciente->id])}}" role="button">Criar atendimento</a>
        </form>
    </div>

@endsection

<script type="text/javascript" src="{{ asset('js/delete.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
