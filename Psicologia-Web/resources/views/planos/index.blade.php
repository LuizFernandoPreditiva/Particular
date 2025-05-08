@extends('layouts.principalLogado')

@section('main')

    <div class="table-container">
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
                    <td><a href="{{route('atendimentos.edit', $pl->id )}}">Editar</a></td>
                    <td><a href="{{route('atendimentos.destroy', $pl )}}">Excluir</a></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>

@endsection
