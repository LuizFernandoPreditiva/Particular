@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Novo pagamento" subtitle="Lançamento para o paciente selecionado.">
    <div class="info-list">
        <div><strong>Paciente:</strong> {{ $paciente->name }}</div>
    </div>

    <form class="form-grid" action="{{ route('pagamentos.store') }}" method="post">
        @csrf

        <input type="hidden" name="user_id" value="{{ $paciente->id }}">

        <x-field label="Descrição" for="descricao">
            <input id="descricao" type="text" name="descricao" class="form-input" required>
        </x-field>

        <div class="form-row">
            <x-field label="Forma" for="forma">
                <select id="forma" name="forma" class="form-input">
                    <option value="pix">Pix</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="credito">Cr?dito</option>
                    <option value="debito">D?bito</option>
                    <option value="unimed">Unimed</option>
                </select>
            </x-field>

            <x-field label="Parcelas" for="parcelas">
                <select id="parcelas" name="parcelas" class="form-input">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </x-field>
        </div>

        <x-field label="Valor" for="valor">
            <input id="valor" type="number" name="valor" class="form-input" required>
        </x-field>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cadastrar</button>
            <a class="btn-secondary" href="{{ route('pagamentos.historico', $paciente) }}">Voltar</a>
        </div>
    </form>
</x-section-card>

@endsection
