@extends('layouts.principalLogado')

@section('main')

    <div class="form-container">

        <form action="{{route('pagamentos.update', $pagamento)}}" method="post">
            @csrf
            @method('PUT')

            <input type="hidden" name="user_id" value="{{$pagamento->user_id}}">

            Descricao: <input type="text" name="descricao" value="{{$pagamento->descricao}}" required><br><br>
            Forma:
            <select name="forma">
                <option value="pix" @if ($pagamento->forma == 'pix') selected @endif>Pix</option>
                <option value="dinheiro" @if ($pagamento->forma == 'dinheiro') selected @endif>Dinheiro</option>
                <option value="credito" @if ($pagamento->forma == 'credito') selected @endif>Credito</option>
                <option value="debito" @if ($pagamento->forma == 'debito') selected @endif>Debito</option>
                <option value="unimed" @if ($pagamento->forma == 'unimed') selected @endif>Unimed</option>
            </select><br><br>
            Parcelas:
            <select name="parcelas">
                <option value="1" @if ($pagamento->parcelas == 1) selected @endif>1</option>
                <option value="2" @if ($pagamento->parcelas == 2) selected @endif>2</option>
                <option value="3" @if ($pagamento->parcelas == 3) selected @endif>3</option>
                <option value="4" @if ($pagamento->parcelas == 4) selected @endif>4</option>
            </select><br><br>
            Valor: <input type="number" name="valor" value="{{$pagamento->valor}}" required><br><br>

            <input  type="submit" value="Alterar">
        </form>

    </div>

@endsection
