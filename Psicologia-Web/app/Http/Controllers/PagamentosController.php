<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Pagamentos;
use Illuminate\Http\Request;

class PagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('pagamentos.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Pagamentos::create($data);
        $cliente = Clientes::findOrFail($data['cliente_id']);

        $cliente->saldo += $data['valor'];
        $cliente->update($data);

        //$clientes = Clientes::all();
        //return view("clientes.index", ['clientes' => $clientes]);
        return redirect()->route('clientes.show', ['cliente' => $cliente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function show(Pagamentos $pagamentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagamentos $pagamento)
    {
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
        $data = $request->all();
        $cliente = Clientes::findOrFail($data['cliente_id']);

        $saldo = $cliente['saldo'];
        $saldo -= $pagamento->valor;
        $saldo += $data['valor'];

        $pagamento->update($data);

        $cliente->update([
            'saldo' => $saldo,
        ]);

        $pagamentos = Pagamentos::where('cliente_id', $data['cliente_id'])->get();

        return view('pagamentos.historico', ['cliente' => $cliente, 'pagamentos' => $pagamentos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagamentos $pagamento)
    {
        $cliente = Clientes::findOrFail($pagamento->cliente_id);

        $saldo = $cliente->saldo;
        $saldo -= $pagamento->valor;

        $cliente->update([
            'saldo' => $saldo,
        ]);

        $pagamento->delete();

        $pagamentos = Pagamentos::where('cliente_id', $cliente->id)->get();

        return redirect()->route('pagamentos.historico', ['cliente' => $cliente, 'pagamentos' => $pagamentos]);
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
        $nome = $request->input('nome');

        $clientes = Clientes::where('users_id', auth()->id())->where('nome', 'like', '%' . $nome . '%')->get();

        return view('pagamentos.busca', ['clientes' => $clientes]);
    }

    public function historico(Clientes $cliente)
    {
        $pagamentos = Pagamentos::where('cliente_id', $cliente->id)->get();
        return view('pagamentos.historico', ['cliente' => $cliente, 'pagamentos' => $pagamentos]);
    }

}
