@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Histórico financeiro" subtitle="Pagamentos do paciente selecionado." class="table-card">
    <x-slot name="actions">
        <a class="btn-primary" href="{{ route('pagamentos.novo', ['id' => $paciente->id]) }}">Novo pagamento</a>
        <a class="btn-secondary" href="{{ route('pacientes.show', $paciente->id) }}">Ver paciente</a>
        <form method="GET" class="per-page-form">
            @foreach (request()->except(['page', 'per_page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <label for="per_page">Itens por página</label>
            <input id="per_page" type="number" name="per_page" min="1" max="100" value="{{ request('per_page', 10) }}">
            <button class="btn-secondary" type="submit">Aplicar</button>
        </form>
    </x-slot>

    <div class="table-meta">
        <div class="info-list">
            <div><strong>ID:</strong> {{ $paciente->id }}</div>
            <div><strong>Nome:</strong> {{ $paciente->name }}</div>
            <div><strong>Saldo:</strong> R${{ $paciente->saldo }}</div>
        </div>
    </div>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Alterar</th>
                    <th>Cancelar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($pagamentos as $pagamento):
                ?>
                <tr>
                    <td><?= $pagamento->descricao ?></td>
                    <td><?= $pagamento->valor ?></td>
                    <td><a class="btn-secondary" href="{{ route('pagamentos.edit', $pagamento->id) }}">Alterar</a></td>
                    <td>
                        <form action="{{ route('pagamentos.destroy', $pagamento) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <div class="table-meta">
        {{ $pagamentos->links('pagination::bootstrap-4') }}
    </div>
</x-section-card>

@endsection
