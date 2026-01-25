@extends('layouts.principalLogado')

@section('main')

    <div class="form-container">

        Paciente: {{$paciente->name}}<br><br>

        <form action="{{route('pagamentos.store')}}" method="post">
            @csrf

            <input type="hidden" name="user_id" value="{{$paciente->id}}">

            Descricao: <input type="text" name="descricao" required><br><br>
            Forma:
            <select name="forma">
                <option value="pix">Pix</option>
                <option value="dinheiro">Dinheiro</option>
                <option value="credito">Credito</option>
                <option value="debito">Debito</option>
                <option value="unimed">Unimed</option>
            </select><br><br>
            Parcelas:
            <select name="parcelas">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select><br><br>
            Valor: <input type="number" name="valor" required><br><br>

            <input  type="submit" value="Cadastrar">
        </form>

    </div>

@endsection
