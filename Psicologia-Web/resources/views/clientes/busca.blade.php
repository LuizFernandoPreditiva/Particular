@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Resultados da busca" subtitle="Clientes encontrados." class="table-card">
    <x-slot name="actions">
        <a class="btn-secondary" href="{{ route('clientes.index') }}">Voltar</a>
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
                    foreach($clientes as $cl):
                ?>
                <tr>
                    <td><?= $cl->nome ?></td>
                    <td><?= $cl->telefone ?></td>
                    <td><?= date('d/m/Y', strtotime($cl->created_at)) ?></td>
                    <td><a href="{{ route('clientes.show', $cl->id) }}">Visualizar</a></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</x-section-card>

@endsection
