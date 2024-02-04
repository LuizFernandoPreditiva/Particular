@extends('layouts.principal')

@section('main')


    <table class="TabelaHistorico">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Novo</th>
                <th>Histórico</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($clientes as $cliente):
            ?>
            <tr>
                <td><?= $cliente->nome ?></td>
                <td><a class="btn btn-primary" href="{{route('pagamentos.novo', ['id' => $cliente->id ] )}}" role="button">X</a></td>
                <td><a class="btn btn-primary" href="{{route('pagamentos.historico', $cliente )}}" role="button">X</a></td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

@endsection
