@extends('layouts.principalLogado')

@section('main')

    <div class="form-container">

        Alterar Plano:<br><br>

        <form action="{{route('planos.update', $plano)}}" method="post">
            @csrf
            @method('PUT')

            nome: <input type="text" name="nome" value="{{$plano->nome}}" required><br><br>
            Descricao: <input type="text" name="descricao" value="{{$plano->descricao}}" required><br><br>
            Valor: <input type="number" name="valor" value="{{$plano->valor}}" required><br><br>

            <input  type="submit" value="Alterar">
        </form>

    </div>

@endsection
