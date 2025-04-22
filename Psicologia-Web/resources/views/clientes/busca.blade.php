@extends('layouts.principalLogado')

@section('main')

    <table class="TabelaClientes">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
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
                <td><a href="{{route('clientes.show', $cl->id )}}">Visualizar</a></td>
                <td><a href="{{route('atendimentos.registro', $cl )}}">Visualizar</a></td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

@endsection
