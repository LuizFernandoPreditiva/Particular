@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Pagamentos" subtitle="Lista geral de pagamentos." class="table-card">
    <x-slot name="actions">
        <a class="btn-secondary" href="{{ route('pagamentos.pesquisar') }}">Buscar paciente</a>
        <form method="GET" class="per-page-form">
            @foreach (request()->except(['page', 'per_page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <label for="per_page">Itens por página</label>
            <input id="per_page" type="number" name="per_page" min="1" max="100" value="{{ request('per_page', 10) }}">
            <button class="btn-secondary" type="submit">Aplicar</button>
        </form>
    </x-slot>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagamentos as $pagamento): ?>
                <tr>
                    <td><?= $pagamento->paciente->name ?></td>
                    <td><?= $pagamento->descricao ?></td>
                    <td><?= $pagamento->valor ?></td>
                    <td><a href="{{ route('pagamentos.show', $pagamento->id) }}">Ver</a></td>
                    <td><a href="{{ route('pagamentos.edit', $pagamento->id) }}">Editar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="table-meta">
        {{ $pagamentos->links('pagination::bootstrap-4') }}
    </div>
</x-section-card>

@endsection
