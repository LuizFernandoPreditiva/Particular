@extends('layouts.principalLogado')

@section('main')

    <div class="table-container">
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
                    <td><a href="{{route('clientes.show', $cl->id )}}">Visualizar</a></td>
                    <td><a href="{{route('atendimentos.registro', $cl )}}">Visualizar</a></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>

@endsection
