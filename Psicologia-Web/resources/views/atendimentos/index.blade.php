@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Atendimentos" subtitle="Registros do paciente selecionado." class="table-card">
    <x-slot name="actions">
        <a class="btn-primary" href="{{ route('atendimentos.create') }}">Novo atendimento</a>
        <a class="btn-secondary" href="{{ url()->previous() }}">Voltar</a>
        <form method="GET" class="per-page-form">
            @foreach (request()->except(['page', 'per_page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <label for="per_page">Itens por página</label>
            <input id="per_page" type="number" name="per_page" min="1" max="100" value="{{ request('per_page', 10) }}">
            <button class="btn-secondary" type="submit">Aplicar</button>
        </form>
    </x-slot>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Agendado</th>
                    <th>Atendido</th>
                    <th>Duração</th>
                    <th>Falta</th>
                    <th>Visualizar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($atendimentos as $atendimento)
                <tr>
                    <td>{{ $atendimento->paciente ? $atendimento->paciente->name : 'Não informado' }}</td>
                    <td>{{ $atendimento->agendamento ? date('d/m/Y H:i', strtotime($atendimento->agendamento)) : '-' }}</td>
                    <td>{{ $atendimento->atendido ? date('d/m/Y H:i', strtotime($atendimento->atendido)) : '-' }}</td>
                    <td>{{ $atendimento->duracao }}</td>
                    <td>{{ $atendimento->falta ? 'Sim' : 'Não' }}</td>
                    <td><a href="{{ route('atendimentos.show', $atendimento) }}">Detalhes</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-meta">
        {{ $atendimentos->links('pagination::bootstrap-4') }}
    </div>
</x-section-card>

@endsection
