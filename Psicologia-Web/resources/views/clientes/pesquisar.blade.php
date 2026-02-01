@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Buscar cliente" subtitle="Encontre clientes pelo nome.">
    <form class="form-grid" action="{{ route('clientes.buscar') }}" method="post">
        @csrf

        <x-field label="Nome" for="nome">
            <input id="nome" type="text" name="nome" class="form-input" required>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Buscar</button>
        </div>
    </form>
</x-section-card>

@endsection
