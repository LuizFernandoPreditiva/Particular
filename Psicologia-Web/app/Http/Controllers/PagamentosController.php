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
        //
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
    public function edit(Pagamentos $pagamentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagamentos $pagamentos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagamentos  $pagamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagamentos $pagamentos)
    {
        //
    }
}
