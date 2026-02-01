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
    public function index(Request $request)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $perPage = $this->perPage($request);

        if (auth()->user()->rules_id === 2) {
            $pacientes = User::where('rules_id', 4)
                ->where('user_id', auth()->id())
                ->orderBy('name', 'asc')
                ->paginate($perPage)
                ->withQueryString();
        } else {
            $pacientes = User::where('rules_id', 4)
                ->orderBy('name', 'asc')
                ->paginate($perPage)
                ->withQueryString();
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
            abort(403, 'Acesso não autorizado.');
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
            abort(403, 'Acesso não autorizado.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'cpf' => 'nullable|string|max:20',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:100',
            'status' => 'required|in:ativo,alta,inativo',
            'planos_id' => 'nullable|exists:planos,id',
            'user_id' => 'nullable|exists:users,id',
        ], [], [
            'name' => 'nome',
            'email' => 'e-mail',
            'password' => 'senha',
            'cpf' => 'CPF',
            'telefone' => 'telefone',
            'endereco' => 'endereço',
            'cidade' => 'cidade',
            'estado' => 'estado',
            'status' => 'status',
            'planos_id' => 'plano',
            'user_id' => 'psicólogo',
        ]);
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
                abort(403, 'Acesso não autorizado.');
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

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $paciente->id,
            'password' => 'nullable|string|min:6',
            'cpf' => 'nullable|string|max:20',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:100',
            'status' => 'required|in:ativo,alta,inativo',
            'planos_id' => 'nullable|exists:planos,id',
            'user_id' => 'nullable|exists:users,id',
        ], [], [
            'name' => 'nome',
            'email' => 'e-mail',
            'password' => 'senha',
            'cpf' => 'CPF',
            'telefone' => 'telefone',
            'endereco' => 'endereço',
            'cidade' => 'cidade',
            'estado' => 'estado',
            'status' => 'status',
            'planos_id' => 'plano',
            'user_id' => 'psicólogo',
        ]);
        $data['rules_id'] = 4;

        if (auth()->user()->rules_id === 2) {
            $data['user_id'] = auth()->id();
        } else {
            $psicologoId = (int) $request->input('user_id');
            $psicologoValido = User::where('id', $psicologoId)->where('rules_id', 2)->exists();

            if (!$psicologoValido) {
                abort(403, 'Acesso não autorizado.');
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
            abort(403, 'Acesso não autorizado.');
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
            abort(403, 'Acesso não autorizado.');
        }

        $perPage = $this->perPage($request);
        $nome = $request->input('nome');

        $query = User::where('rules_id', 4)->where('name', 'like', '%' . $nome . '%');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->orderBy('name', 'asc')
            ->paginate($perPage)
            ->appends(['nome' => $nome, 'per_page' => $perPage]);

        return view('pacientes.busca', ['pacientes' => $pacientes]);
    }

    public function ativo(Request $request)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $perPage = $this->perPage($request);
        $query = User::where('rules_id', 4)->where('status', 'ativo');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();

        return view('pacientes.ativo', ['pacientes' => $pacientes]);
    }

    public function alta(Request $request)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $perPage = $this->perPage($request);
        $query = User::where('rules_id', 4)->where('status', 'alta');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();

        return view('pacientes.alta', ['pacientes' => $pacientes]);
    }

    public function inativo(Request $request)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $perPage = $this->perPage($request);
        $query = User::where('rules_id', 4)->where('status', 'inativo');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();

        return view('pacientes.inativo', ['pacientes' => $pacientes]);
    }

    private function autorizarPaciente(User $paciente)
    {
        if ($paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }
    }
}
