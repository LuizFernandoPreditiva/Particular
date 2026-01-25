@extends('layouts.principalLogado')

@section('main')

    <div class="exibir-cliente">
        <h1>Plano:</h1>
        <p>
            Nome: {{$plano->nome}}<br>
            Descricao: {{$plano->descricao}}<br>
            Valor: {{$plano->valor}}<br>
        </p>

        <a class="btn btn-primary" href="{{route('planos.edit', $plano->id )}}" role="button">Alterar</a>
        <form action="{{route('planos.destroy', $plano)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary">Deletar</button>
        </form>
    </div>

@endsection
