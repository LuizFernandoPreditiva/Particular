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

<h1>Novo atendimento:</h1>

<form action="{{route('atendimentos.store')}}" method="post">
    @csrf

    Paciente:
    <select name="cliente_id">
        <?php
        foreach ($clientes as $cliente):
        ?>
            <option value='{{$cliente->id}}'>{{$cliente->nome}}</option>
        <?php
        endforeach;
        ?>
    </select><br>
    Data de agendamento: <input type="date" name='dataAgendamento' required><br>
    Hora do agendamento: <input type="time" name='horaAgendamento' required><br>
    Data do atendimento: <input type="date" name='dataAtendido'><br>
    Hora do atendimento: <input type="time" name='horaAtendido'><br>
    Duracao: <input type="number" name='duracao'><br>
    Falta: <input type='checkbox' name='falta' value="1"><br>
    Trabalho: <textarea name='trabalho' maxlength="1000" rows="4" cols="50"></textarea><br>
    Resumo: <textarea name='resumo' maxlength="1000" rows="4" cols="50"></textarea><br>

    <input  type="submit" value="Cadastrar">
</form>

</body>

</html>

