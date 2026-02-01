@extends('layouts.principalLogado')

@section('main')

<div class="foto-bg">
    <div class="conteudo-texto">
        <h1>Natalia Cabette Lanini Duarte</h1>
        <p>Psicóloga</p>
        <a class="btn-primary" href="{{ route('pacientes.index') }}">Ver pacientes</a>
    </div>
</div>

@endsection
