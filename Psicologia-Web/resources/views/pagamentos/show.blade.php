@extends('layouts.principalLogado')

@section('main')

    <div class="exibir-cliente">
        <h1>Pagamento:</h1>
        <p>
            Paciente: {{$pagamento->paciente->name}}<br>
            Descricao: {{$pagamento->descricao}}<br>
            Forma: {{$pagamento->forma}}<br>
            Parcelas: {{$pagamento->parcelas}}<br>
            Valor: {{$pagamento->valor}}<br>
        </p>

        <a class="btn btn-primary" href="{{route('pagamentos.edit', $pagamento->id )}}" role="button">Alterar</a>
        <form action="{{route('pagamentos.destroy', $pagamento)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary">Deletar</button>
        </form>
    </div>

@endsection
