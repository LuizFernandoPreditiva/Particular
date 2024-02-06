<?php

namespace App\Http\Controllers;

use App\Models\Atendimentos;
use App\Models\Clientes;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Clientes::all();

        return view('atendimentos.create', ['clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dataAgendado = $request->input('dataAgendamento');
        $horaAgendado = $request->input('horaAgendamento');
        $dataHoraAgendamento = "{$dataAgendado} {$horaAgendado}";

        if($request->input('dataAtendido') == null || $request->input('horaAtendido') == null){
            $dataHoraAtendido = null;
        }else{
            $dataAtendido = $request->input('dataAtendido');
            $horaAtendido = $request->input('horaAtendido');
            $dataHoraAtendido = "{$dataAtendido} {$horaAtendido}";
        }


        if($request->input('falta') == null){
            $falta = 0;
        }else{
            $falta = 1;
        }

        Atendimentos::create([
            'cliente_id' => $request->input('cliente_id'),
            'agendamento' => $dataHoraAgendamento,
            'atendido' => $dataHoraAtendido,
            'duracao' => $request->input('duracao'),
            'falta' => $falta,
            'trabalho' => $request->input('trabalho'),
            'resumo' => $request->input('resumo')
        ]);

        $cliente = Clientes::findOrFail($request->input('cliente_id'));

        $faltas = $cliente->faltas;
        $faltas += $falta;
        $atendimentos = $cliente->atendimentos;
        $atendimentos += 1;

        $cliente->update([
            'faltas' => $faltas,
            'atendimentos' => $atendimentos,
        ]);

        return redirect()->route('clientes.show', ['cliente' => $cliente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atendimentos  $atendimentos
     * @return \Illuminate\Http\Response
     */
    public function show(Atendimentos $atendimentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atendimentos  $atendimentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Atendimentos $atendimento)
    {
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

        $dataAgendado = $request->input('dataAgendamento');
        $horaAgendado = $request->input('horaAgendamento');
        $dataHoraAgendamento = "{$dataAgendado} {$horaAgendado}";

        $dataAtendido = $request->input('dataAtendido');
        $horaAtendido = $request->input('horaAtendido');
        $dataHoraAtendido = $dataAtendido && $horaAtendido ? "{$dataAtendido} {$horaAtendido}" : null;

        $falta = $request->has('falta') ? 1 : 0;

        //calcular as faltas para atualizar o cliente
        $faltaAnterior = $atendimento->falta;
        $faltaNova = 0;

        if($faltaAnterior > $falta){
            $faltaNova -= 1;
        }else if($faltaAnterior < $falta){
            $faltaNova += 1;
        }else{
            $faltaNova = 0;
        }
        //fim do calculo

        $atendimento->update([
            'agendamento' => $dataHoraAgendamento,
            'atendido' => $dataHoraAtendido,
            'duracao' => $request->input('duracao'),
            'falta' => $falta,
            'trabalho' => $request->input('trabalho'),
            'resumo' => $request->input('resumo')
        ]);

        $cliente = Clientes::findOrFail($request->input('cliente_id'));


        //apenas manter.
        $atendimentos = $cliente->atendimentos;

        $faltas = $cliente->faltas;
        $faltas += $faltaNova;

        $cliente->update([
            'faltas' => $faltas,
            'atendimentos' => $atendimentos,
        ]);

        return redirect()->route('atendimentos.registro', ['cliente' => $cliente, 'atendimentos' => $cliente->atendimentos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atendimentos  $atendimentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atendimentos $atendimento)
    {
        $cliente = Clientes::findOrFail($atendimento->cliente_id);

        $falta = 0;
        if($atendimento->falta == 1){
            $falta -= 1;
        }else{
            $falta = 0;
        }

        $faltas = $cliente->faltas;
        $faltas += $falta;

        $atendimento->delete();

        $atendimentos = $cliente->atendimentos;
        $atendimentos -= 1;

        $cliente->update([
            'faltas' => $faltas,
            'atendimentos' => $atendimentos,
        ]);

        $atendimentos = Atendimentos::where('cliente_id', $cliente->id)->get();

        return redirect()->route('atendimentos.registro', ['cliente' => $cliente, 'atendimentos' => $atendimentos]);
    }

    public function registro(Clientes $cliente)
    {
        $atendimentos = Atendimentos::where('cliente_id', $cliente->id)->get();
        return view('atendimentos.registro', ['cliente' => $cliente, 'atendimentos' => $atendimentos]);
    }
}
