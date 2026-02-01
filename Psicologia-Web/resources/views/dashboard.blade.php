@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Painel" subtitle="Resumo rapido do sistema.">
    <div class="info-list">
        <div><strong>Status:</strong> Voce esta logado!</div>
        <div><strong>Data:</strong> {{ date('d/m/Y') }}</div>
    </div>
</x-section-card>

@endsection
