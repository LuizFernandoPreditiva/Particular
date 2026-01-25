@extends('layouts.principalLogado')

@section('main')

    <div class="agenda-container">
        <div class="agenda-header">
            <a class="btn btn-primary" href="{{ route('atendimentos.agenda', ['week' => $weekStart->copy()->subWeek()->toDateString()]) }}">Semana anterior</a>
            <div class="agenda-title">
                Semana de {{ $weekStart->format('d/m/Y') }} ate {{ $weekEnd->format('d/m/Y') }}
            </div>
            <a class="btn btn-primary" href="{{ route('atendimentos.agenda', ['week' => $weekStart->copy()->addWeek()->toDateString()]) }}">Proxima semana</a>
        </div>

        <table class="agenda-table">
            <thead>
                <tr>
                    <th>Hora</th>
                    <?php
                        $dias = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'];
                    ?>
                    <?php for ($i = 0; $i < 7; $i++): ?>
                        <?php $dia = $weekStart->copy()->addDays($i); ?>
                        <th><?= $dias[$i] ?><br><?= $dia->format('d/m') ?></th>
                    <?php endfor; ?>
                </tr>
            </thead>
            <tbody>
                <?php for ($hora = 0; $hora < 24; $hora++): ?>
                    <tr>
                        <td class="agenda-hour"><?= str_pad($hora, 2, '0', STR_PAD_LEFT) ?>:00</td>
                        <?php for ($i = 0; $i < 7; $i++): ?>
                            <?php $dia = $weekStart->copy()->addDays($i); ?>
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
                                    <?php if ($canEdit): ?>
                                        <a class="agenda-item <?= $statusClass ?>" href="{{ route('atendimentos.edit', $item->id) }}">
                                            <?= $label ?>
                                        </a>
                                    <?php else: ?>
                                        <a class="agenda-item <?= $statusClass ?>" href="{{ route('atendimentos.show', $item->id) }}">
                                            <?= $label ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>

    <style>
        .agenda-container { width: 100%; padding-top: 80px; }
        .agenda-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; gap: 12px; flex-wrap: wrap; }
        .agenda-title { font-weight: bold; }
        .agenda-table { width: 100%; border-collapse: collapse; }
        .agenda-table th, .agenda-table td { border: 1px solid #ddd; padding: 6px; vertical-align: top; }
        .agenda-hour { width: 70px; font-weight: bold; text-align: center; }
        .agenda-cell { min-height: 48px; }
        .agenda-item { display: block; color: inherit; text-decoration: none; padding: 4px 6px; margin-bottom: 4px; border-radius: 4px; font-size: 12px; }
        .agenda-item:hover { text-decoration: underline; }
        .status-falta { background: #f8d7da; border: 1px solid #f5c2c7; }
        .status-atendido { background: #d1e7dd; border: 1px solid #badbcc; }
        .status-pendente { background: #ffffff; border: 1px solid #ddd; }
    </style>

@endsection
