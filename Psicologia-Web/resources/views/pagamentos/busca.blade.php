@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Resultados da busca" subtitle="Selecione acoes para o paciente." class="table-card">
    <x-slot name="actions">
        <a class="btn-secondary" href="{{ route('pagamentos.pesquisar') }}">Nova busca</a>
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
                    <th>Novo</th>
                    <th>Histórico</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($pacientes as $paciente):
                ?>
                <tr>
                    <td><?= $paciente->name ?></td>
                    <td><a class="btn-primary" href="{{ route('pagamentos.novo', ['id' => $paciente->id]) }}">Novo</a></td>
                    <td><a class="btn-secondary" href="{{ route('pagamentos.historico', $paciente) }}">Histórico</a></td>
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
