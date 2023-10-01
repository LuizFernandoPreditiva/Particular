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
    Nome: {{$cliente->nome}} -> <a href="{{route('clientes.show', $cliente->id )}}">ver</a><br>
    Saldo: R${{$cliente->saldo}}<br><br>

    <table id="TabelaHistorico" border=1 align="center">
        <thead>
            <tr>
                <th>Descricao</th>
                <th>Valor</th>
                <th>Alterar</th>
                <th>Cancelar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($pagamentos as $pagamento):
            ?>
            <tr>
                <td><?= $pagamento->descricao ?></td>
                <td><?= $pagamento->valor ?></td>
                <td><a class="btn btn-primary" href="{{route('pagamentos.edit', $pagamento->id )}}" role="button">Alterar</a></td>
                <td>
                    <form action="{{route('pagamentos.destroy', $pagamento)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Deletar</button>
                    </form>
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>






    </body>

</html>
