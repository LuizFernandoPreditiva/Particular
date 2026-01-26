<?php

namespace App\Http\Controllers;

use App\Models\Planos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacientesController extends Controller
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

        if (auth()->user()->rules_id === 2) {
            $pacientes = User::where('rules_id', 4)
                ->where('user_id', auth()->id())
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $pacientes = User::where('rules_id', 4)
                ->orderBy('name', 'asc')
                ->get();
        }

        return view('pacientes.index', ['pacientes' => $pacientes]);
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

        $psicologos = [];
        if (in_array(auth()->user()->rules_id, [1, 3], true)) {
            $psicologos = User::where('rules_id', 2)->orderBy('name', 'asc')->get();
        }

        if (auth()->user()->rules_id === 2) {
            $planos = Planos::where('user_id', auth()->id())->get();
        } else {
            $planos = Planos::orderBy('nome', 'asc')->get();
        }

        return view('pacientes.create', compact('planos', 'psicologos'));
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

        $data = $request->all();
        $data['rules_id'] = 4;
        $data['saldo'] = 0;
        $data['atendimentos'] = 0;
        $data['faltas'] = 0;

        if (auth()->user()->rules_id === 2) {
            $data['user_id'] = auth()->id();
        } else {
            $psicologoId = (int) $request->input('user_id');
            $psicologoValido = User::where('id', $psicologoId)->where('rules_id', 2)->exists();

            if (!$psicologoValido) {
                abort(403, 'Acesso nao autorizado.');
            }

            $data['user_id'] = $psicologoId;
        }

        $data['password'] = Hash::make($request->input('password'));

        User::create($data);

        return redirect()->route("pacientes.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(User $paciente)
    {
        $this->autorizarPaciente($paciente);

        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(User $paciente)
    {
        $this->autorizarPaciente($paciente);

        $psicologos = [];
        if (in_array(auth()->user()->rules_id, [1, 3], true)) {
            $psicologos = User::where('rules_id', 2)->orderBy('name', 'asc')->get();
        }

        if (auth()->user()->rules_id === 2) {
            $planos = Planos::where('user_id', auth()->id())->get();
        } else {
            $planos = Planos::orderBy('nome', 'asc')->get();
        }

        return view('pacientes.edit', compact('paciente', 'planos', 'psicologos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $paciente)
    {
        $this->autorizarPaciente($paciente);

        $data = $request->all();
        $data['rules_id'] = 4;

        if (auth()->user()->rules_id === 2) {
            $data['user_id'] = auth()->id();
        } else {
            $psicologoId = (int) $request->input('user_id');
            $psicologoValido = User::where('id', $psicologoId)->where('rules_id', 2)->exists();

            if (!$psicologoValido) {
                abort(403, 'Acesso nao autorizado.');
            }

            $data['user_id'] = $psicologoId;
        }

        if (!empty($request->input('password'))) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            unset($data['password']);
        }

        $paciente->update($data);

        return redirect()->route('pacientes.show', ['paciente' => $paciente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $paciente)
    {
        $this->autorizarPaciente($paciente);

        $paciente->delete();

        return redirect()->route('pacientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisar()
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        return view('pacientes.pesquisar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        $nome = $request->input('nome');

        $query = User::where('rules_id', 4)->where('name', 'like', '%' . $nome . '%');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->get();

        return view('pacientes.busca', ['pacientes' => $pacientes]);
    }

    public function ativo()
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        $query = User::where('rules_id', 4)->where('status', 'ativo');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->get();

        return view('pacientes.ativo', ['pacientes' => $pacientes]);
    }

    public function alta()
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        $query = User::where('rules_id', 4)->where('status', 'alta');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->get();

        return view('pacientes.alta', ['pacientes' => $pacientes]);
    }

    public function inativo()
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }

        $query = User::where('rules_id', 4)->where('status', 'inativo');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->get();

        return view('pacientes.inativo', ['pacientes' => $pacientes]);
    }

    private function autorizarPaciente(User $paciente)
    {
        if ($paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso nao autorizado.');
        }

        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso nao autorizado.');
        }
    }
}
