@extends('layouts.principal')

@section('main')

<h1>Pesquise pelo Nome:</h1>

<form action="{{route('pagamentos.buscar')}}" method="post">
    @csrf

    Nome: <input type="text" name="nome" required><br><br>

    <input  type="submit" value="Buscar">
</form>

@endsection
