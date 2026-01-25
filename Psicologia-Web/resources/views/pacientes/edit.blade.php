@extends('layouts.principalLogado')

@section('main')

    <div class="form-container">

        <form action="{{route('pacientes.update', $paciente )}}" method="post">
            @csrf
            @method('PUT')

            Nome: <input type="text" name="name" value="{{$paciente->name}}" required><br><br>
            Email: <input type="email" name="email" value="{{$paciente->email}}" required><br><br>
            Senha: <input type="password" name="password"><br><br>
            CPF: <input type="text" name="cpf" value="{{$paciente->cpf}}"><br><br>
            Telefone: <input type="text" name="telefone" value="{{$paciente->telefone}}"><br><br>
            Endereco: <input type="text" name="endereco" value="{{$paciente->endereco}}"><br><br>
            Cidade: <input type="text" name="cidade" value="{{$paciente->cidade}}"><br><br>
            Estado: <input type="text" name="estado" value="{{$paciente->estado}}"><br><br>
            Status:
            <select name="status">
                <option value="ativo" @if ($paciente->status == 'ativo') selected @endif>Em atendimento</option>
                <option value="alta" @if ($paciente->status == 'alta') selected @endif>De alta</option>
                <option value="inativo" @if ($paciente->status == 'inativo') selected @endif>Desistencia</option>
            </select><br><br>
            @if (auth()->user()->rules_id === 2)
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            @elseif (auth()->user()->rules_id === 1 || auth()->user()->rules_id === 3)
                Psicologo:
                <select name="user_id" required>
                    @foreach ($psicologos as $index => $psicologo)
                        <option value="{{ $psicologo->id }}" {{ $paciente->user_id == $psicologo->id ? 'selected' : '' }}>
                        {{ $psicologo->name }}
                        </option>
                    @endforeach
                </select><br><br>
            @endif
            Plano:
            <select name="planos_id">
                @foreach ($planos as $index => $plano)
                    <option value="{{ $plano->id }}" {{ $paciente->planos_id == $plano->id ? 'selected' : '' }}>
                    {{ $plano->nome }}
                    </option>
                @endforeach
            </select><br><br>

            <input  type="submit" value="Alterar">
        </form>

    </div>

@endsection
