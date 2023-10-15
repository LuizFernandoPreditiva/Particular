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
<body>

    @component("components.menulogout")
    @endcomponent

    @component("components.logo")
    @endcomponent

    @component("components.menuLogado")
    @endcomponent

<h1>Pesquise pelo Nome:</h1>

<form action="{{route('pagamentos.buscar')}}" method="post">
    @csrf

    Nome: <input type="text" name="nome" required><br><br>

    <input  type="submit" value="Buscar">
</form>

</body>

</html>
