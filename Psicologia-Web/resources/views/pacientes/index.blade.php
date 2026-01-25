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
                    <th>Novo atendimento</th>
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
                    <td><a href="{{route('pacientes.show', $pc->id )}}">Visualizar</a></td>
                    <td><a href="{{route('atendimentos.registro', $pc )}}">Visualizar</a></td>
                    <td><a href="{{route('atendimentos.create', ['user_id' => $pc->id])}}">Criar atendimento</a></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>

@endsection
