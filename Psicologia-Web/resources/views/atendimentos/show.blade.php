@extends('layouts.principalLogado')

@section('main')

    <div class="exibir-cliente">
        <h1>Atendimento:</h1>
        <p>
            Paciente: {{$atendimento->paciente->name}}<br>
            Agendado: {{ date('d/m/Y H:i', strtotime($atendimento->agendamento)) }}<br>
            Atendido:
            @if ($atendimento->falta == 1)
                Faltou
            @elseif ($atendimento->atendido == null)
                Nao atendido
            @else
                {{ date('d/m/Y H:i', strtotime($atendimento->atendido)) }}
            @endif
            <br>
            Duracao: {{$atendimento->duracao}}<br>
            Trabalho: {{$atendimento->trabalho}}<br>
            Resumo: {{$atendimento->resumo}}<br>
        </p>

        <a class="btn btn-primary" href="{{route('atendimentos.edit', $atendimento->id )}}" role="button">Alterar</a>
        <form action="{{route('atendimentos.destroy', $atendimento)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary">Cancelar</button>
        </form>
    </div>

@endsection
