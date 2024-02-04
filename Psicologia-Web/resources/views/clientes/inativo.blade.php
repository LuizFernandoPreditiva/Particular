@extends('layouts.principal')

@section('main')

    @component("components.menulogout")
    @endcomponent

    @component("components.logo")
    @endcomponent

    @component("components.menuLogado")
    @endcomponent

    <table class="TabelaClientes">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Visualizar</th>
                <th>Serviços</th>
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
                <td><a href="">X</a></td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

@endsection
