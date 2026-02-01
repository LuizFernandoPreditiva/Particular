@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Editar pagamento" subtitle="Atualize os dados do pagamento.">
    <form class="form-grid" action="{{ route('pagamentos.update', $pagamento) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="user_id" value="{{ $pagamento->user_id }}">

        <x-field label="Descrição" for="descricao">
            <input id="descricao" type="text" name="descricao" class="form-input" value="{{ $pagamento->descricao }}" required>
        </x-field>

        <div class="form-row">
            <x-field label="Forma" for="forma">
                <select id="forma" name="forma" class="form-input">
                    <option value="pix" @if ($pagamento->forma == 'pix') selected @endif>Pix</option>
                    <option value="dinheiro" @if ($pagamento->forma == 'dinheiro') selected @endif>Dinheiro</option>
                    <option value="credito" @if ($pagamento->forma == 'credito') selected @endif>Cr?dito</option>
                    <option value="debito" @if ($pagamento->forma == 'debito') selected @endif>D?bito</option>
                    <option value="unimed" @if ($pagamento->forma == 'unimed') selected @endif>Unimed</option>
                </select>
            </x-field>

            <x-field label="Parcelas" for="parcelas">
                <select id="parcelas" name="parcelas" class="form-input">
                    <option value="1" @if ($pagamento->parcelas == 1) selected @endif>1</option>
                    <option value="2" @if ($pagamento->parcelas == 2) selected @endif>2</option>
                    <option value="3" @if ($pagamento->parcelas == 3) selected @endif>3</option>
                    <option value="4" @if ($pagamento->parcelas == 4) selected @endif>4</option>
                </select>
            </x-field>
        </div>

        <x-field label="Valor" for="valor">
            <input id="valor" type="number" name="valor" class="form-input" value="{{ $pagamento->valor }}" required>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Salvar</button>
            <a class="btn-secondary" href="{{ url()->previous() }}">Voltar</a>
        </div>
    </form>
</x-section-card>

@endsection
