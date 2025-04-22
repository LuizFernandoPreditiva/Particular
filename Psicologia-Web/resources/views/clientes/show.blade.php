@extends('layouts.principalLogado')

@section('main')


    <h1>Cliente:</h1>
    ID: {{$cliente->id}}<br>
    Nome: {{$cliente->nome}}<br>
    CPF: {{$cliente->cpf}}<br>
    Telefone: {{$cliente->telefone}}<br>
    Endereco: {{$cliente->endereco}}<br>
    Cidade: {{$cliente->cidade}}<br>
    Estado: {{$cliente->estado}}<br>
    status: {{$cliente->status}}<br>
    Atendimentos: {{$cliente->atendimentos}}<br>
    Faltas: {{$cliente->faltas}}<br>
    Saldo: {{$cliente->saldo}}<br>

    <form action="{{route('clientes.destroy', $cliente)}}" method="post">
        <a class="btn btn-primary" href="{{route('clientes.edit', $cliente->id )}}" role="button">Alterar</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary">Deletar</button>
        <a class="btn btn-primary" href="{{route('pagamentos.novo', ['id' => $cliente->id ] )}}" role="button">Novo Pagamento</a>
        <a class="btn btn-primary" href="{{route('pagamentos.historico', $cliente )}}" role="button">Financeiro</a>
        <a class="btn btn-primary" href="{{route('atendimentos.registro', $cliente )}}" role="button">Atendimentos</a>
    </form>

@endsection
