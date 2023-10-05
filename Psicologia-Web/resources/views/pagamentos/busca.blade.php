<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Pesquisar pacientes</title>
</head>
<body class="fundo">

    @component("components.menulogout")
    @endcomponent

    @component("components.logo")
    @endcomponent

    @component("components.menuLogado")
    @endcomponent

    <table class="TabelaHistorico">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Novo</th>
                <th>Histórico</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($clientes as $cliente):
            ?>
            <tr>
                <td><?= $cliente->nome ?></td>
                <td><a class="btn btn-primary" href="{{route('pagamentos.novo', ['id' => $cliente->id ] )}}" role="button">X</a></td>
                <td><a class="btn btn-primary" href="{{route('pagamentos.historico', $cliente )}}" role="button">X</a></td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

</body>

</html>
