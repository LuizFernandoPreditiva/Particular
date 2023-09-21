<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Clientes</title>
</head>
<body class="fundo">

    @component("components.logo")
    @endcomponent

    @component("components.menuLogado")
    @endcomponent

<h1>Clientes:</h1>

<table id="TabelaClientes" border=1 align="center">
    <h3><a href="{{route('clientes.create')}}">Criar novo</a></h3>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Visualizar</th>
            <th>Serviços</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($clientes as $cl):
        ?>
        <tr>
            <td><?= $cl->nome ?></td>
            <td><?= $cl->telefone ?></td>
            <td><a href="{{route('clientes.show', $cl->id )}}">Visualizar</a></td>
            <td><a href="">X</a></td>
        </tr>
        <?php
            endforeach;
        ?>
    </tbody>
</table>

</body>

</html>
