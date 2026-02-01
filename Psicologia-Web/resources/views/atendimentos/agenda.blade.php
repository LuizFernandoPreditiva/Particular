@extends('layouts.principalLogado')

@section('main')

<x-section-card title="Agenda" subtitle="Visualize atendimentos por período.">
    <div class="agenda-header">
        <a class="btn-secondary" href="{{ route('atendimentos.agenda', $prevParams) }}">Período anterior</a>
        <form class="agenda-range" method="GET" action="{{ route('atendimentos.agenda') }}">
            <span>De</span>
            <input type="date" name="from" value="{{ $displayStart->toDateString() }}">
            <span>até</span>
            <input type="date" name="to" value="{{ $displayEnd->toDateString() }}">
            <button class="btn-primary" type="submit">Ir</button>
        </form>
        <a class="btn-secondary" href="{{ route('atendimentos.agenda', $nextParams) }}">Próximo período</a>
    </div>

    @if ($isPaciente)
        <div class="agenda-paciente">
            <?php foreach ($pacienteAgenda as $dayKey => $items): ?>
                <?php $dia = \Carbon\Carbon::parse($dayKey); ?>
                <div class="agenda-dia">
                    <div class="agenda-dia-titulo">{{ $dia->format('d/m/Y') }}</div>
                    <?php foreach ($items as $item): ?>
                        <?php
                            $statusClass = 'status-pendente';
                            $statusTexto = 'Agendado';
                            if ($item->falta == 1) {
                                $statusClass = 'status-falta';
                                $statusTexto = 'Falta';
                            } elseif ($item->atendido != null) {
                                $statusClass = 'status-atendido';
                                $statusTexto = 'Atendido';
                            }
                            $hora = \Carbon\Carbon::parse($item->agendamento)->format('H:i');
                        ?>
                        <div class="agenda-item <?= $statusClass ?>">
                            {{ $hora }} - {{ $statusTexto }}
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            @if (empty($pacienteAgenda))
                <div>Nenhum atendimento neste período.</div>
            @endif
        </div>
    @else
        <div class="table-scroll">
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th>Hora</th>
                        <?php
                            $dias = [1 => 'Seg', 2 => 'Ter', 3 => 'Qua', 4 => 'Qui', 5 => 'Sex', 6 => 'Sab', 7 => 'Dom'];
                        ?>
                        <?php foreach ($days as $dia): ?>
                            <th><?= $dias[$dia->dayOfWeekIso] ?><br><?= $dia->format('d/m') ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($hora = 0; $hora < 24; $hora++): ?>
                        <tr>
                            <td class="agenda-hour"><?= str_pad($hora, 2, '0', STR_PAD_LEFT) ?>:00</td>
                            <?php foreach ($days as $dia): ?>
                                <?php $dayKey = $dia->toDateString(); ?>
                                <?php $items = $agenda[$dayKey][$hora] ?? []; ?>
                                <td class="agenda-cell">
                                    <?php foreach ($items as $item): ?>
                                        <?php
                                            $paciente = $item->paciente;
                                            $psicologo = $paciente->psicologo ? $paciente->psicologo->name : 'Sem psicologo';
                                            $label = $isAdminOrAtendente ? $paciente->name . ' - ' . $psicologo : $paciente->name;
                                            $statusClass = 'status-pendente';
                                            if ($item->falta == 1) {
                                                $statusClass = 'status-falta';
                                            } elseif ($item->atendido != null) {
                                                $statusClass = 'status-atendido';
                                            }
                                        ?>
                                        <a class="agenda-item <?= $statusClass ?>" href="{{ route('atendimentos.edit', $item->id) }}">
                                            <?= $label ?>
                                        </a>
                                    <?php endforeach; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    @endif
</x-section-card>

@endsection
