@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Planos" subtitle="Gerencie os planos cadastrados." class="table-card">
    <x-slot name="actions">
        <a class="btn-primary" href="{{ route('planos.create') }}">Novo plano</a>
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
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Editar</th>
                    <th>Apagar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($planos as $pl):
                ?>
                <tr>
                    <td><?= $pl->nome ?></td>
                    <td><?= $pl->descricao ?></td>
                    <td><?= $pl->valor ?></td>
                    <td><a href="{{ route('planos.edit', $pl->id) }}">Editar</a></td>
                    <td>
                        <form action="{{ route('planos.destroy', $pl) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <div class="table-meta">
        {{ $planos->links('pagination::bootstrap-4') }}
    </div>
</x-section-card>

@endsection
