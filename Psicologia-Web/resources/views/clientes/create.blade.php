@extends('layouts.principal')

@section('main')

<h1>Novo cliente:</h1>

<form action="{{route('clientes.store')}}" method="post">
    @csrf

    Nome: <input type="text" name="nome" required><br><br>
    CPF: <input type="text" name="cpf" required><br><br>
    Telefone: <input type="text" name="telefone" required><br><br>
    Endereco: <input type="text" name="endereco" required><br><br>
    Cidade: <input type="text" name="cidade" required><br><br>
    Estado: <input type="text" name="estado" required><br><br>
    Status:
    <select name="status">
        <option value="ativo">Em atendimento</option>
        <option value="alta">De alta</option>
        <option value="inativo">Desistencia</option>
    </select><br><br>

    <input  type="submit" value="Cadastrar">
</form>

@endsection
