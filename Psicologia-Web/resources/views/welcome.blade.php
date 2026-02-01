@extends('layouts.principal')

@section('header')
    <x-headerDeslogado></x-headerDeslogado>
@endsection

@section('main')

<x-section-card title="Bem-vindo" subtitle="Acesse o painel para gerenciar pacientes, atendimentos e pagamentos.">
    <div class="form-actions">
        <a class="btn-primary" href="{{ route('login') }}">Entrar</a>
        @if (Route::has('register'))
            <a class="btn-secondary" href="{{ route('register') }}">Cadastrar</a>
        @endif
    </div>
</x-section-card>

@endsection
