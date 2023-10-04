<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Paciente</title>
</head>
<body class="fundo">

    @component("components.menulogout")
    @endcomponent

    @component("components.logo")
    @endcomponent

    @component("components.menuLogado")
    @endcomponent

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

    </body>

</html>
