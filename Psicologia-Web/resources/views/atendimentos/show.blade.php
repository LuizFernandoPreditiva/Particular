@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Atendimento" subtitle="Detalhes do atendimento.">
    <div class="info-list">
        <div><strong>Paciente:</strong> {{ $atendimento->paciente->name }}</div>
        <div><strong>Agendado:</strong> {{ date('d/m/Y H:i', strtotime($atendimento->agendamento)) }}</div>
        <div><strong>Atendido:</strong>
            @if ($atendimento->falta == 1)
                Faltou
            @elseif ($atendimento->atendido == null)
                Não atendido
            @else
                {{ date('d/m/Y H:i', strtotime($atendimento->atendido)) }}
            @endif
        </div>
        <div><strong>Duração:</strong> {{ $atendimento->duracao }}</div>
        <div><strong>Trabalho:</strong> {{ $atendimento->trabalho }}</div>
        <div><strong>Resumo:</strong> {{ $atendimento->resumo }}</div>
    </div>

    <div class="form-actions">
        <a class="btn-primary" href="{{ route('atendimentos.edit', $atendimento->id) }}">Alterar</a>
        <form action="{{ route('atendimentos.destroy', $atendimento) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Cancelar</button>
        </form>
    </div>
</x-section-card>

@endsection
