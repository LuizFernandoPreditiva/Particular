@extends('layouts.principalLogado')

@section('main')

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Descricao</th>
                    <th>Valor</th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagamentos as $pagamento): ?>
                <tr>
                    <td><?= $pagamento->paciente->name ?></td>
                    <td><?= $pagamento->descricao ?></td>
                    <td><?= $pagamento->valor ?></td>
                    <td><a href="{{route('pagamentos.show', $pagamento->id )}}">Ver</a></td>
                    <td><a href="{{route('pagamentos.edit', $pagamento->id )}}">Editar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

@endsection
