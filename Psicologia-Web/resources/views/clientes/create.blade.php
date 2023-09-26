<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Novo paciente</title>
</head>
<body class="fundo">

    @component("components.menulogout")
    @endcomponent

    @component("components.logo")
    @endcomponent

    @component("components.menuLogado")
    @endcomponent

<h1>Novo cliente:</h1>

<form action="{{route('clientes.store')}}" method="post">
    @csrf

    Nome: <input type="text" name="nome"><br><br>
    CPF: <input type="text" name="cpf"><br><br>
    Telefone: <input type="text" name="telefone"><br><br>
    Endereco: <input type="text" name="endereco"><br><br>
    Cidade: <input type="text" name="cidade"><br><br>
    Estado: <input type="text" name="estado"><br><br>
    Status:
    <select name="status">
        <option value="ativo">Em atendimento</option>
        <option value="alta">De alta</option>
        <option value="inativo">Desistencia</option>
    </select><br><br>

    <input  type="submit" value="Cadastrar">
</form>

</body>

</html>

