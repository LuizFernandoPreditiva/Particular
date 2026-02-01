@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Novo atendimento" subtitle="Registre um novo atendimento para o paciente.">
    <form class="form-grid" action="{{ route('atendimentos.store') }}" method="post">
        @csrf

        <x-field label="Paciente" for="user_id">
            <select id="user_id" name="user_id" class="form-input">
                <?php
                foreach ($pacientes as $paciente):
                    $selecionado = request('user_id') == $paciente->id ? 'selected' : '';
                ?>
                    <option value='{{$paciente->id}}' {{$selecionado}}>{{$paciente->name}}</option>
                <?php
                endforeach;
                ?>
            </select>
        </x-field>

        <div class="form-row">
            <x-field label="Data de agendamento" for="dataAgendamento">
                <input id="dataAgendamento" type="date" name="dataAgendamento" class="form-input" required>
            </x-field>

            <x-field label="Hora do agendamento" for="horaAgendamento">
                <input id="horaAgendamento" type="time" name="horaAgendamento" class="form-input" required>
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Data do atendimento" for="dataAtendido">
                <input id="dataAtendido" type="date" name="dataAtendido" class="form-input">
            </x-field>

            <x-field label="Hora do atendimento" for="horaAtendido">
                <input id="horaAtendido" type="time" name="horaAtendido" class="form-input">
            </x-field>
        </div>

        <div class="form-row">
            <x-field label="Duração (min)" for="duracao">
                <input id="duracao" type="number" name="duracao" class="form-input">
            </x-field>

            <x-field label="Falta" for="falta">
                <div class="checkbox-row">
                    <input id="falta" type="checkbox" name="falta" value="1">
                    <label for="falta">Marcar como falta</label>
                </div>
            </x-field>
        </div>

        <x-field label="Trabalho" for="trabalho">
            <textarea id="trabalho" name="trabalho" maxlength="1000" rows="4" class="form-input"></textarea>
        </x-field>

        <x-field label="Resumo" for="resumo">
            <textarea id="resumo" name="resumo" maxlength="1000" rows="4" class="form-input"></textarea>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cadastrar</button>
        </div>
    </form>
</x-section-card>

@endsection
