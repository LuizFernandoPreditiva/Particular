@extends('layouts.principalLogado')

@section('main')

    <div class="table-container">

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
                    <td><a class="btn btn-primary" href="{{route('pagamentos.novo', ['id' => $paciente->id ] )}}" role="button">X</a></td>
                    <td><a class="btn btn-primary" href="{{route('pagamentos.historico', $paciente )}}" role="button">X</a></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>

    </div>

@endsection
