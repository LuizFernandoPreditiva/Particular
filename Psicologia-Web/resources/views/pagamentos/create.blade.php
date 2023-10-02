<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>lancar pagamento</title>
</head>
<body class="fundo">

    @component("components.menulogout")
    @endcomponent

    @component("components.logo")
    @endcomponent

    @component("components.menuLogado")
    @endcomponent

    Paciente: {{$cliente->nome}}<br><br>

    <form action="{{route('pagamentos.store')}}" method="post">
        @csrf

        <input type="hidden" name="cliente_id" value="{{$cliente->id}}">

        Descricao: <input type="text" name="descricao" required><br><br>
        Forma:
        <select name="forma">
            <option value="pix">Pix</option>
            <option value="dinheiro">Dinheiro</option>
            <option value="credito">Credito</option>
            <option value="debito">Debito</option>
            <option value="unimed">Unimed</option>
        </select><br><br>
        Parcelas:
        <select name="parcelas">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br><br>
        Valor: <input type="number" name="valor" required><br><br>

        <input  type="submit" value="Cadastrar">
    </form>
</body>
</html>
