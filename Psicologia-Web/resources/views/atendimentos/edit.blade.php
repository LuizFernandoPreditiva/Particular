@extends('layouts.principalLogado')

@section('main')

    <div class="form-container">

        <form action="{{route('atendimentos.update', $atendimento )}}" method="post">
            @csrf
            @method('PUT')

            <input type="hidden" name="cliente_id" value="{{$atendimento->cliente_id}}">

            Data de agendamento: <input type="date" name='dataAgendamento'
                value="{{ $atendimento->agendamento ? date('Y-m-d', strtotime($atendimento->agendamento)) : '' }}" required><br>
            Hora do agendamento: <input type="time" name='horaAgendamento'
                value="{{ $atendimento->agendamento ? date('H:i', strtotime($atendimento->agendamento)) : '' }}" required><br>
            Data do atendimento: <input type="date" name='dataAtendido'
                value="{{ $atendimento->atendido ? date('Y-m-d', strtotime($atendimento->atendido)) : '' }}" ><br>
            Hora do atendimento: <input type="time" name='horaAtendido'
                value="{{ $atendimento->atendido ? date('H:i', strtotime($atendimento->atendido)) : '' }}"><br>
            Duracao: <input type="number" name='duracao' value="{{$atendimento->duracao}}"><br>
            Falta: <input type='checkbox' name='falta' value="1"
                @if($atendimento->falta == 1)
                checked
                @endif
            ><br>
            Trabalho: <textarea name='trabalho' maxlength="1000" rows="4" cols="50">{{ $atendimento->trabalho }}</textarea><br>
            Resumo: <textarea name='resumo' maxlength="1000" rows="4" cols="50">{{$atendimento->resumo}}</textarea><br>

            <input  type="submit" value="Alterar">

        </form>

    </div>

@endsection
