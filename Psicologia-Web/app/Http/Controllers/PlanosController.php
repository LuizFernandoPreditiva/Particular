<?php

namespace App\Http\Controllers;

use App\Models\Planos;
use Illuminate\Http\Request;

class PlanosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planos = Planos::where('users_id', auth()->id())
            ->orderBy('nome', 'asc')->get();

        return view("planos.index", ['planos' => $planos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('planos.create');
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
        $data['users_id'] = auth()->id();

        Planos::create($data);

        $planos = Planos::where('users_id', auth()->id())
            ->orderBy('nome', 'asc')->get();

        return redirect()->route("planos.index", compact('planos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planos  $planos
     * @return \Illuminate\Http\Response
     */
    public function show(Planos $planos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planos  $planos
     * @return \Illuminate\Http\Response
     */
    public function edit(Planos $planos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planos  $planos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planos $planos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planos  $planos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planos $plano)
    {
        $plano->delete();

        $planos = Planos::where('users_id', auth()->id())->orderBy('nome', 'asc')->get();

        return redirect()->route("planos.index", compact('planos'));
    }
}
