@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Editar atendimento" subtitle="Atualize os dados do atendimento.">
    <form class="form-grid" action="{{ route('atendimentos.update', $atendimento) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="user_id" value="{{ $atendimento->user_id }}">

        <div class="form-row">
            <x-field label="Data de agendamento" for="dataAgendamento">
                <input id="dataAgendamento" type="date" name="dataAgendamento" class="form-input"
                    value="{{ $atendimento->agendamento ? date('Y-m-d', strtotime($atendimento->agendamento)) : '' }}" required>
            </x-field>

            <x-field label="Hora do agendamento" for="horaAgendamento">
                <input id="horaAgendamento" type="time" name="horaAgendamento" class="form-input"
                    value="{{ $atendimento->agendamento ? date('H:i', strtotime($atendimento->agendamento)) : '' }}" required>
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Data do atendimento" for="dataAtendido">
                <input id="dataAtendido" type="date" name="dataAtendido" class="form-input"
                    value="{{ $atendimento->atendido ? date('Y-m-d', strtotime($atendimento->atendido)) : '' }}">
            </x-field>

            <x-field label="Hora do atendimento" for="horaAtendido">
                <input id="horaAtendido" type="time" name="horaAtendido" class="form-input"
                    value="{{ $atendimento->atendido ? date('H:i', strtotime($atendimento->atendido)) : '' }}">
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Duração (min)" for="duracao">
                <input id="duracao" type="number" name="duracao" class="form-input" value="{{ $atendimento->duracao }}">
            </x-field>

            <x-field label="Falta" for="falta">
                <div class="checkbox-row">
                    <input id="falta" type="checkbox" name="falta" value="1" @if($atendimento->falta == 1) checked @endif>
                    <label for="falta">Marcar como falta</label>
                </div>
            </x-field>
        </div>

        <x-field label="Trabalho" for="trabalho">
            <textarea id="trabalho" name="trabalho" maxlength="1000" rows="4" class="form-input">{{ $atendimento->trabalho }}</textarea>
        </x-field>

        <x-field label="Resumo" for="resumo">
            <textarea id="resumo" name="resumo" maxlength="1000" rows="4" class="form-input">{{ $atendimento->resumo }}</textarea>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Salvar</button>
            <a class="btn-secondary" href="{{ url()->previous() }}">Voltar</a>
        </div>
    </form>
</x-section-card>

@endsection
