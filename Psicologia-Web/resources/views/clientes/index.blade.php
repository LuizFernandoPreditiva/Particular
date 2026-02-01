@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Clientes" subtitle="Lista geral de clientes." class="table-card">
    <x-slot name="actions">
        <a class="btn-primary" href="{{ route('clientes.create') }}">Novo cliente</a>
        <a class="btn-secondary" href="{{ route('clientes.pesquisar') }}">Buscar</a>
    </x-slot>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Registrado</th>
                    <th>Visualizar</th>
                    <th>Atendimentos</th>
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
                    <td><a href="{{ route('atendimentos.registro', $cl) }}">Visualizar</a></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</x-section-card>

@endsection
