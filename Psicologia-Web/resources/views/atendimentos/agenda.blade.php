@extends('layouts.principalLogado')

@section('main')

    <div class="agenda-container">
        <div class="agenda-header">
            <a class="btn btn-primary" href="{{ route('atendimentos.agenda', $prevParams) }}">Periodo anterior</a>
            <div class="agenda-title">
                <form class="agenda-range" method="GET" action="{{ route('atendimentos.agenda') }}">
                    <span>De</span>
                    <input type="date" name="from" value="{{ $displayStart->toDateString() }}">
                    <span>ate</span>
                    <input type="date" name="to" value="{{ $displayEnd->toDateString() }}">
                    <button class="btn btn-primary" type="submit">Ir</button>
                </form>
            </div>
            <a class="btn btn-primary" href="{{ route('atendimentos.agenda', $nextParams) }}">Proximo periodo</a>
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
                    <div>Nenhum atendimento neste periodo.</div>
                @endif
            </div>
        @else
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
        @endif
    </div>

    <style>
        .agenda-container { width: 100%; padding-top: 80px; }
        .agenda-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; gap: 12px; flex-wrap: wrap; }
        .agenda-title { font-weight: bold; }
        .agenda-range { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; justify-content: center; }
        .agenda-range input[type="date"] { padding: 4px; }
        .agenda-paciente { display: grid; gap: 12px; }
        .agenda-dia { border: 1px solid #ddd; border-radius: 6px; padding: 8px; background: #fff; }
        .agenda-dia-titulo { font-weight: bold; margin-bottom: 6px; }
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
