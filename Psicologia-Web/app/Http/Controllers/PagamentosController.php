<?php

namespace App\Http\Controllers;

use App\Models\Pagamentos;
use App\Models\User;
use Illuminate\Http\Request;

class PagamentosController extends Controller
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
        $pagamentos = Pagamentos::whereHas('paciente', function ($query) {
            $query->where('rules_id', 4)
                ->when(auth()->user()->rules_id === 2, function ($query) {
                    $query->where('user_id', auth()->id());
                });
        })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('pagamentos.index', compact('pagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $paciente = User::where('id', $id)
            ->where('rules_id', 4)
            ->firstOrFail();

        if (auth()->user()->rules_id === 2 && $paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('pagamentos.create', compact('paciente'));
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

        $data = $request->all();
        $paciente = User::where('id', $data['user_id'])
            ->where('rules_id', 4)
            ->firstOrFail();

        if (auth()->user()->rules_id === 2 && $paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        Pagamentos::create($data);

        $paciente->saldo += $data['valor'];
        $paciente->save();

        return redirect()->route('pacientes.show', ['paciente' => $paciente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function show(Pagamentos $pagamentos)
    {
        if (!$pagamentos->paciente || $pagamentos->paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $pagamentos->paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('pagamentos.show', ['pagamento' => $pagamentos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagamentos $pagamento)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        if (!$pagamento->paciente || $pagamento->paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $pagamento->paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('pagamentos.edit', compact('pagamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagamentos $pagamento)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        if (!$pagamento->paciente || $pagamento->paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $pagamento->paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $data = $request->all();
        $paciente = User::where('id', $data['user_id'])
            ->where('rules_id', 4)
            ->firstOrFail();

        $saldo = $paciente['saldo'];
        $saldo -= $pagamento->valor;
        $saldo += $data['valor'];

        $pagamento->update($data);

        $paciente->update([
            'saldo' => $saldo,
        ]);

        return redirect()->route('pagamentos.historico', ['paciente' => $paciente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagamentos $pagamento)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        if (!$pagamento->paciente || $pagamento->paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $pagamento->paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $paciente = User::findOrFail($pagamento->user_id);

        $saldo = $paciente->saldo;
        $saldo -= $pagamento->valor;

        $paciente->update([
            'saldo' => $saldo,
        ]);

        $pagamento->delete();

        return redirect()->route('pagamentos.historico', ['paciente' => $paciente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisar()
    {
        return view('pagamentos.pesquisar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $perPage = $this->perPage($request);
        $nome = $request->input('nome');

        $query = User::where('rules_id', 4)->where('name', 'like', '%' . $nome . '%');

        if (auth()->user()->rules_id === 2) {
            $query->where('user_id', auth()->id());
        }

        $pacientes = $query->orderBy('name', 'asc')
            ->paginate($perPage)
            ->appends(['nome' => $nome, 'per_page' => $perPage]);

        return view('pagamentos.busca', ['pacientes' => $pacientes]);
    }

    public function historico(Request $request, User $paciente)
    {
        if ($paciente->rules_id !== 4) {
            abort(404);
        }

        if (auth()->user()->rules_id === 2 && $paciente->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        } else if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $perPage = $this->perPage($request);
        $pagamentos = Pagamentos::where('user_id', $paciente->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
        return view('pagamentos.historico', ['paciente' => $paciente, 'pagamentos' => $pagamentos]);
    }
}
