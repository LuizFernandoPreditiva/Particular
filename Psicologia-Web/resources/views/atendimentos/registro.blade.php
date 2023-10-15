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
<body>

    @component("components.menulogout")
    @endcomponent

    @component("components.logo")
    @endcomponent

    @component("components.menuLogado")
    @endcomponent

    <h1>Cliente:</h1>
    ID: {{$cliente->id}}<br>
    Nome: {{$cliente->nome}} -> <a href="{{route('clientes.show', $cliente->id )}}">ver</a><br><br>

    <table class="TabelaRegistro">
        <thead>
            <tr>
                <th>Agendado</th>
                <th>Atendido</th>
                <th>Alterar</th>
                <th>Cancelar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($atendimentos as $atendimento):
            ?>
            <tr>
                <td><?= date('d/m/Y H:m', strtotime($atendimento->agendamento)) ?></td>
                <td><?php
                        if($atendimento->falta == 1){
                            echo 'Faltou';
                        }
                        else if($atendimento->atendido == null){
                            echo 'Não atendido';
                        }else{
                            echo date('d/m/Y H:m', strtotime($atendimento->atendido));
                        }
                    ?></td>
                <td>X</td>
                <td>X</td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>






    </body>

</html>
