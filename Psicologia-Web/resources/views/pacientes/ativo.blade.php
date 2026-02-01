@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Pacientes em atendimento" subtitle="Acompanhamentos ativos." class="table-card">
    <x-slot name="actions">
        <a class="btn-secondary" href="{{ route('pacientes.index') }}">Voltar</a>
        <form method="GET" class="per-page-form">
            @foreach (request()->except(['page', 'per_page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <label for="per_page">Itens por página</label>
            <input id="per_page" type="number" name="per_page" min="1" max="100" value="{{ request('per_page', 10) }}">
            <button class="btn-secondary" type="submit">Aplicar</button>
        </form>
    </x-slot>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Registrado</th>
                    <th>Visualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($pacientes as $pc):
                ?>
                <tr>
                    <td><?= $pc->name ?></td>
                    <td><?= $pc->telefone ?></td>
                    <td><?= date('d/m/Y', strtotime($pc->created_at)) ?></td>
                    <td><a href="{{ route('pacientes.show', $pc->id) }}">Visualizar</a></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <div class="table-meta">
        {{ $pacientes->links('pagination::bootstrap-4') }}
    </div>
</x-section-card>

@endsection
