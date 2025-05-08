@extends('layouts.principalLogado')

@section('main')

    <div class="form-container">

        Novo Plano:<br><br>

        <form action="{{route('planos.store')}}" method="post">
            @csrf

            nome: <input type="text" name="nome" required><br><br>
            Descrição: <input type="text" name="descricao" required><br><br>
            Valor: <input type="number" name="valor" required><br><br>

            <input  type="submit" value="Cadastrar">
        </form>

    </div>

@endsection
