@extends('layouts.principalLogado')

@section('main')

    <div class="form-container">
        <form action="{{route('clientes.update', $cliente )}}" method="post">
            @csrf
            @method('PUT')

            Nome: <input type="text" name="nome" value="{{$cliente->nome}}" required><br><br>
            CPF: <input type="text" name="cpf" value="{{$cliente->cpf}}" required><br><br>
            Telefone: <input type="text" name="telefone" value="{{$cliente->telefone}}" required><br><br>
            Endereco: <input type="text" name="endereco" value="{{$cliente->endereco}}" required><br><br>
            Cidade: <input type="text" name="cidade" value="{{$cliente->cidade}}" required><br><br>
            Estado: <input type="text" name="estado" value="{{$cliente->estado}}" required><br><br>
            Status:
                <select name="status">
                    <option value="ativo" @if ($cliente->status == 'ativo') selected @endif>Em atendimento</option>
                    <option value="alta" @if ($cliente->status == 'alta') selected @endif>De alta</option>
                    <option value="inativo" @if ($cliente->status == 'inativo') selected @endif>Desistencia</option>
                </select><br><br>
            Plano:
            <select name="plano_id" required>
                @foreach($planos as $plano)
                    <option value="{{ $plano->id }}" @if ($cliente->plano_id == $plano->id) selected @endif>
                        {{ $plano->nome }}
                    </option>
                @endforeach
            </select><br><br>

            <input  type="submit" class="btn btn-primary" value="Salvar">
        </form>

    </div>

@endsection
