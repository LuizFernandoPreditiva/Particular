<?php

namespace App\Http\Controllers;

use App\Models\Atendimentos;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class AtendimentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        $atendimentos = Atendimentos::whereHas('paciente', function ($query) {
            $query->where('rules_id', 4)
                ->when(auth()->user()->rules_id === 2, function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->where(function ($statusQuery) {
                    $statusQuery->whereNull('status')
                        ->orWhere('status', 'ativo');
                });
        })
            ->orderBy('agendamento', 'desc')
            ->get();

        return view('atendimentos.index', compact('atendimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        $pacientes = User::where('rules_id', 4)
            ->when(auth()->user()->rules_id === 2, function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('atendimentos.create', ['pacientes' => $pacientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        $paciente = User::where('id', $request->input('user_id'))
            ->where('rules_id', 4)
            ->firstOrFail();

        if (auth()->user()->rules_id === 2 && $paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso nao autorizado.');
        }

        $dataAgendado = $request->input('dataAgendamento');
        $horaAgendado = $request->input('horaAgendamento');
        $dataHoraAgendamento = "{$dataAgendado} {$horaAgendado}";

        if ($request->input('dataAtendido') == null || $request->input('horaAtendido') == null) {
            $dataHoraAtendido = null;
        } else {
            $dataAtendido = $request->input('dataAtendido');
            $horaAtendido = $request->input('horaAtendido');
            $dataHoraAtendido = "{$dataAtendido} {$horaAtendido}";
        }

        if ($request->input('falta') == null) {
            $falta = 0;
        } else {
            $falta = 1;
        }

        Atendimentos::create([
            'user_id' => $paciente->id,
            'agendamento' => $dataHoraAgendamento,
            'atendido' => $dataHoraAtendido,
            'duracao' => $request->input('duracao'),
            'falta' => $falta,
            'trabalho' => $request->input('trabalho'),
            'resumo' => $request->input('resumo')
        ]);

        $faltas = $paciente->faltas;
        $faltas += $falta;
        $atendimentos = $paciente->atendimentos;
        $atendimentos += 1;

        //Calcula o valor do plano para abater no saldo
        //se tiver inserido com data de finalizacao
        if ($dataHoraAtendido != null) {
            $valorPlano = $paciente->plano ? $paciente->plano->valor : 0;

            $paciente->update([
                'faltas' => $faltas,
                'atendimentos' => $atendimentos,
                'saldo' => $paciente->saldo - $valorPlano,
            ]);
        } else {
            $paciente->update([
                'faltas' => $faltas,
                'atendimentos' => $atendimentos,
            ]);
        }

        return redirect()->route('pacientes.show', ['paciente' => $paciente->fresh()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atendimentos  $atendimentos
     * @return \Illuminate\Http\Response
     */
    public function show(Atendimentos $atendimentos)
    {
        if ($atendimentos->paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        if (auth()->user()->rules_id === 2 && $atendimentos->paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso nao autorizado.');
        }

        return view('atendimentos.show', ['atendimento' => $atendimentos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atendimentos  $atendimentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Atendimentos $atendimento)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        if ($atendimento->paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $atendimento->paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso nao autorizado.');
        }

        return view('atendimentos.edit', compact('atendimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Atendimentos  $atendimentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atendimentos $atendimento)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        if ($atendimento->paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $atendimento->paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso nao autorizado.');
        }

        $dataAgendado = $request->input('dataAgendamento');
        $horaAgendado = $request->input('horaAgendamento');
        $dataHoraAgendamento = "{$dataAgendado} {$horaAgendado}";

        $dataAtendido = $request->input('dataAtendido');
        $horaAtendido = $request->input('horaAtendido');
        $dataHoraAtendido = $dataAtendido && $horaAtendido ? "{$dataAtendido} {$horaAtendido}" : null;

        $falta = $request->has('falta') ? 1 : 0;

        //calcular as faltas para atualizar o paciente
        $faltaAnterior = $atendimento->falta;
        $faltaNova = 0;

        if ($faltaAnterior > $falta) {
            $faltaNova -= 1;
        } else if ($faltaAnterior < $falta) {
            $faltaNova += 1;
        } else {
            $faltaNova = 0;
        }
        //fim do calculo

        $paciente = User::findOrFail($request->input('user_id'));

        //apenas manter.
        $atendimentos = $paciente->atendimentos;

        $faltas = $paciente->faltas;
        $faltas += $faltaNova;

        //Calcula o valor do plano para abater no saldo
        //se tiver inserido sem data de hora atendido
        $valorPlano = $paciente->plano ? $paciente->plano->valor : 0;

        if ($atendimento->atendido !== null && $dataHoraAtendido === null) {
            $paciente->update([
                'faltas' => $faltas,
                'atendimentos' => $atendimentos,
                'saldo' => $paciente->saldo + $valorPlano,
            ]);
        }
        // Se nao era atendido e agora e -> descontar
        elseif ($atendimento->atendido === null && $dataHoraAtendido !== null) {
            $paciente->update([
                'faltas' => $faltas,
                'atendimentos' => $atendimentos,
                'saldo' => $paciente->saldo - $valorPlano,
            ]);
        }
        // Nenhuma mudanca no status de atendimento
        else {
            $paciente->update([
                'faltas' => $faltas,
                'atendimentos' => $atendimentos,
            ]);
        }

        $atendimento->update([
            'agendamento' => $dataHoraAgendamento,
            'atendido' => $dataHoraAtendido,
            'duracao' => $request->input('duracao'),
            'falta' => $falta,
            'trabalho' => $request->input('trabalho'),
            'resumo' => $request->input('resumo')
        ]);

        return redirect()->route('atendimentos.registro', ['paciente' => $paciente, 'atendimentos' => $paciente->atendimentos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atendimentos  $atendimentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atendimentos $atendimento)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        if ($atendimento->paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $atendimento->paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso nao autorizado.');
        }

        $paciente = User::findOrFail($atendimento->user_id);

        $falta = 0;
        if ($atendimento->falta == 1) {
            $falta -= 1;
        } else {
            $falta = 0;
        }

        $dataHoraAtendido = $atendimento->atendido;

        $faltas = $paciente->faltas;
        $faltas += $falta;

        $atendimentos = $paciente->atendimentos;
        $atendimentos -= 1;

        $valorPlano = $paciente->plano ? $paciente->plano->valor : 0;

        if ($atendimento->atendido !== null) {
            $paciente->update([
                'faltas' => $faltas,
                'atendimentos' => $atendimentos,
                'saldo' => $paciente->saldo + $valorPlano,
            ]);
        }
        else {
            $paciente->update([
                'faltas' => $faltas,
                'atendimentos' => $atendimentos,
            ]);
        }

        $atendimento->delete();

        $atendimentos = Atendimentos::where('user_id', $paciente->id)->get();

        return redirect()->route('atendimentos.registro', ['paciente' => $paciente, 'atendimentos' => $atendimentos]);
    }

    public function registro(User $paciente)
    {
        if ($paciente->rules_id != 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso nao autorizado.');
        }

        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        // Busca os atendimentos do paciente
        $atendimentos = Atendimentos::where('user_id', $paciente->id)->get();

        return view('atendimentos.registro', ['paciente' => $paciente, 'atendimentos' => $atendimentos]);
    }

    public function agenda(Request $request)
    {
        $isPaciente = auth()->user()->rules_id === 4;
        $from = $request->query('from');
        $to = $request->query('to');

        if ($from && $to) {
            $rangeStart = Carbon::parse($from)->startOfDay();
            $rangeEnd = Carbon::parse($to)->endOfDay();

            if ($rangeStart->gt($rangeEnd)) {
                [$rangeStart, $rangeEnd] = [$rangeEnd->copy()->startOfDay(), $rangeStart->copy()->endOfDay()];
            }
        } else {
            $rangeStart = Carbon::parse($request->query('week', Carbon::now()))
                ->startOfWeek(Carbon::MONDAY)
                ->startOfDay();
            $rangeEnd = $rangeStart->copy()->addDays(6)->endOfDay();
        }

        $weekStart = $rangeStart->copy()->startOfDay();
        $rangeDays = $rangeStart->copy()->startOfDay()->diffInDays($rangeEnd->copy()->startOfDay()) + 1;

        if ($from && $to) {
            $prevStart = $rangeStart->copy()->subDays($rangeDays)->toDateString();
            $prevEnd = $rangeEnd->copy()->subDays($rangeDays)->toDateString();
            $nextStart = $rangeStart->copy()->addDays($rangeDays)->toDateString();
            $nextEnd = $rangeEnd->copy()->addDays($rangeDays)->toDateString();

            $prevParams = ['from' => $prevStart, 'to' => $prevEnd];
            $nextParams = ['from' => $nextStart, 'to' => $nextEnd];
        } else {
            $prevParams = ['week' => $weekStart->copy()->subWeek()->toDateString()];
            $nextParams = ['week' => $weekStart->copy()->addWeek()->toDateString()];
        }

        $query = Atendimentos::with(['paciente.psicologo'])
            ->whereBetween('agendamento', [$rangeStart, $rangeEnd])
            ->whereHas('paciente', function ($query) {
                $query->where('rules_id', 4);
            });

        if (auth()->user()->rules_id === 2) {
            $query->whereHas('paciente', function ($query) {
                $query->where('user_id', auth()->id());
            });
        } elseif ($isPaciente) {
            $query->where('user_id', auth()->id());
        }

        $atendimentos = $query->orderBy('agendamento')->get();

        $agenda = [];
        foreach ($atendimentos as $atendimento) {
            $data = Carbon::parse($atendimento->agendamento);
            $dayKey = $data->toDateString();
            $hourKey = (int) $data->format('H');
            $agenda[$dayKey][$hourKey][] = $atendimento;
        }

        $pacienteAgenda = [];
        if ($isPaciente) {
            foreach ($atendimentos as $atendimento) {
                $data = Carbon::parse($atendimento->agendamento);
                $dayKey = $data->toDateString();
                $pacienteAgenda[$dayKey][] = $atendimento;
            }
        }

        $days = [];
        foreach (CarbonPeriod::create($rangeStart->copy()->startOfDay(), $rangeEnd->copy()->startOfDay()) as $day) {
            $days[] = $day->copy();
        }

        return view('atendimentos.agenda', [
            'agenda' => $agenda,
            'weekStart' => $weekStart,
            'displayStart' => $rangeStart->copy()->startOfDay(),
            'displayEnd' => $rangeEnd->copy()->endOfDay(),
            'prevParams' => $prevParams,
            'nextParams' => $nextParams,
            'days' => $days,
            'isAdminOrAtendente' => in_array(auth()->user()->rules_id, [1, 3], true),
            'canEdit' => auth()->user()->rules_id !== 4,
            'isPaciente' => $isPaciente,
            'pacienteAgenda' => $pacienteAgenda,
        ]);
    }
}
