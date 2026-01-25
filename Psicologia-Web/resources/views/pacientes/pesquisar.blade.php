@extends('layouts.principalLogado')

@section('main')

    <div class="form-container">

        Buscar paciente:<br><br>

        <form action="{{route('pacientes.buscar')}}" method="post">
            @csrf

            Nome: <input type="text" name="nome" required><br><br>

            <input  type="submit" value="Buscar">
        </form>

    </div>

@endsection
