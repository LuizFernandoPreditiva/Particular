@extends('layouts.principalLogado')

@section('main')

    <div class="table-container">

        <h1>Paciente:</h1>
        ID: {{$paciente->id}}<br>
        Nome: {{$paciente->name}} -> <a href="{{route('pacientes.show', $paciente->id )}}">ver</a><br>
        Saldo: R${{$paciente->saldo}}<br><br>

        <table>
            <thead>
                <tr>
                    <th>Descricao</th>
                    <th>Valor</th>
                    <th>Alterar</th>
                    <th>Cancelar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($pagamentos as $pagamento):
                ?>
                <tr>
                    <td><?= $pagamento->descricao ?></td>
                    <td><?= $pagamento->valor ?></td>
                    <td><a class="btn btn-primary" href="{{route('pagamentos.edit', $pagamento->id )}}" role="button">Alterar</a></td>
                    <td>
                        <form action="{{route('pagamentos.destroy', $pagamento)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Deletar</button>
                        </form>
                    </td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>

    </div>

@endsection
