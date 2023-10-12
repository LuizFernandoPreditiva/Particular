<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Clientes::orderBy('nome', 'asc')->get();
        return view("clientes.index", ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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
        $data['saldo'] = 0;
        $data['atendimentos'] = 0;
        $data['faltas'] = 0;

        Clientes::create($data);

        $clientes = Clientes::orderBy('nome', 'asc')->get();
        return view("clientes.index", ['clientes' => $clientes]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $cliente)
    {
        //$cliente = Clientes::findOrFail($id);
        //return view('clientes.show', ['cliente' => $clientes]);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $cliente)
    {

        $data = $request->all();
        $cliente->update($data);

        //$clientes = Clientes::all();
        //return redirect()->route('clientes.index', ['clientes' => $clientes]);
        return redirect()->route('clientes.show', ['cliente' => $cliente]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $cliente)
    {

        $cliente->delete();

        $clientes = Clientes::all();

        return redirect()->route('clientes.index', ['clientes' => $clientes]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisar()
    {
        return view('clientes.pesquisar');
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

        $clientes = Clientes::where('nome', 'like', '%' . $nome . '%')->get();

        return view('clientes.busca', ['clientes' => $clientes]);
    }

    public function ativo()
    {
        $clientes = Clientes::where('status', 'ativo')->get();

        return view('clientes.ativo', ['clientes' => $clientes]);

    }

    public function alta()
    {
        $clientes = Clientes::where('status', 'alta')->get();

        return view('clientes.alta', ['clientes' => $clientes]);

    }

    public function inativo()
    {
        $clientes = Clientes::where('status', 'inativo')->get();

        return view('clientes.inativo', ['clientes' => $clientes]);

    }


}
