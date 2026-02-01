@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Atendimentos do paciente" subtitle="Histórico de agendamentos e atendimentos." class="table-card">
    <x-slot name="actions">
        <a class="btn-secondary" href="{{ route('pacientes.show', $paciente->id) }}">Ver paciente</a>
        <a class="btn-primary" href="{{ route('atendimentos.create', ['user_id' => $paciente->id]) }}">Novo atendimento</a>
        <form method="GET" class="per-page-form">
            @foreach (request()->except(['page', 'per_page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <label for="per_page">Itens por página</label>
            <input id="per_page" type="number" name="per_page" min="1" max="100" value="{{ request('per_page', 10) }}">
            <button class="btn-secondary" type="submit">Aplicar</button>
        </form>
    </x-slot>

    <div class="table-meta">
        <div class="info-list">
            <div><strong>ID:</strong> {{ $paciente->id }}</div>
            <div><strong>Nome:</strong> {{ $paciente->name }}</div>
        </div>
    </div>

    <div class="table-scroll">
        <table>
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
                    <td><?= date('d/m/Y H:i', strtotime($atendimento->agendamento)) ?></td>
                    <td>
                        <?php
                            if($atendimento->falta == 1){
                                echo 'Faltou';
                            }
                            else if($atendimento->atendido == null){
                                echo 'Não atendido';
                            }else{
                                echo date('d/m/Y H:i', strtotime($atendimento->atendido));
                            }
                        ?>
                    </td>
                    <td><a href="{{ route('atendimentos.edit', $atendimento->id) }}" class="btn-secondary">Alterar</a></td>
                    <td>
                        <form action="{{ route('atendimentos.destroy', $atendimento) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Cancelar</button>
                        </form>
                    </td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <div class="table-meta">
        {{ $atendimentos->links('pagination::bootstrap-4') }}
    </div>
</x-section-card>

@endsection
