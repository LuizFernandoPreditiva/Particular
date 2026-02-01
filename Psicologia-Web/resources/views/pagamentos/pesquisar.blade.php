@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Buscar pagamentos" subtitle="Encontre pagamentos pelo nome do paciente.">
    <form class="form-grid" action="{{ route('pagamentos.buscar') }}" method="get">

        <x-field label="Nome" for="nome">
            <input id="nome" type="text" name="nome" class="form-input" required>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Buscar</button>
        </div>
    </form>
</x-section-card>

@endsection
