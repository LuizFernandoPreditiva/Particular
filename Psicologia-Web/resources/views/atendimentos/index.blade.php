@extends('layouts.principalLogado')

@section('main')

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Agendado</th>
                    <th>Atendido</th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($atendimentos as $atendimento): ?>
                <tr>
                    <td><?= $atendimento->paciente->name ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($atendimento->agendamento)) ?></td>
                    <td>
                        <?php
                            if ($atendimento->falta == 1) {
                                echo 'Faltou';
                            } elseif ($atendimento->atendido == null) {
                                echo 'Nao atendido';
                            } else {
                                echo date('d/m/Y H:i', strtotime($atendimento->atendido));
                            }
                        ?>
                    </td>
                    <td><a href="{{route('atendimentos.show', $atendimento->id )}}">Ver</a></td>
                    <td><a href="{{route('atendimentos.edit', $atendimento->id )}}">Editar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

@endsection
