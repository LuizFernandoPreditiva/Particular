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
    public function index(Request $request)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $perPage = $this->perPage($request);

        $planos = Planos::where('user_id', auth()->id())
            ->orderBy('nome', 'asc')
            ->paginate($perPage)
            ->withQueryString();

        return view("planos.index", ['planos' => $planos]);

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
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $data = $request->all();
        $data['user_id'] = auth()->id();

        Planos::create($data);

        $perPage = $this->perPage($request);

        $planos = Planos::where('user_id', auth()->id())
            ->orderBy('nome', 'asc')
            ->paginate($perPage)
            ->withQueryString();

        return redirect()->route("planos.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planos  $planos
     * @return \Illuminate\Http\Response
     */
    public function show(Planos $plano)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        if ($plano->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('planos.show', compact('plano'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planos  $planos
     * @return \Illuminate\Http\Response
     */
    public function edit(Planos $plano)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        if ($plano->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('planos.edit', compact('plano'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planos  $planos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planos $plano)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        if ($plano->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $data = $request->all();
        $plano->update($data);

        return redirect()->route('planos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planos  $planos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planos $plano)
    {
        if (auth()->user()->rules_id === 4) {
            abort(403, 'Acesso não autorizado.');
        }

        $plano->delete();

        $planos = Planos::where('user_id', auth()->id())->orderBy('nome', 'asc')->get();

        return redirect()->route("planos.index");
    }
}
