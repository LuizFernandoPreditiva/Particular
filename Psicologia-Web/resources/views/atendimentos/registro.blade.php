@extends('layouts.principal')

@section('main')

    <h1>Cliente:</h1>
    ID: {{$cliente->id}}<br>
    Nome: {{$cliente->nome}} -> <a href="{{route('clientes.show', $cliente->id )}}">ver</a><br><br>

    <table class="TabelaRegistro">
        <thead>
            <tr>
                <th>Agendado</th>
                <th>Atendido</th>
                <th>Alterar</th>
                <th>Cancelar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($atendimentos as $atendimento):
            ?>
            <tr>
                <td><?= date('d/m/Y H:m', strtotime($atendimento->agendamento)) ?></td>
                <td><?php
                        if($atendimento->falta == 1){
                            echo 'Faltou';
                        }
                        else if($atendimento->atendido == null){
                            echo 'Não atendido';
                        }else{
                            echo date('d/m/Y H:m', strtotime($atendimento->atendido));
                        }
                    ?></td>
                <td><a href="{{route('atendimentos.edit', $atendimento->id )}}" class="btn btn-primary">Alterar</a></td>
                <td><form action="{{route('atendimentos.destroy', $atendimento)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Cancelar</button>
                </form></td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>

@endsection
