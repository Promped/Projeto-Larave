<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $veiculos = Veiculo::with('transportadora')->paginate(10);
        return view('veiculos.index', compact('veiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transportadoras = \App\Models\Transportadora::all();
        return view('veiculos.create', compact('transportadoras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'placa' => 'required|unique:veiculos,placa',
            'tipo' => 'required',
            'modelo' => 'required',
            'transportadora_id' => 'required|exists:transportadoras,id',
            'status_acesso' => 'required|in:ativo,inativo,bloqueado',
        ]);

        Veiculo::create($validated);

        return redirect()
            ->route('veiculos.index')
            ->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        return view('veiculos.show', compact('veiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Veiculo $veiculo)
    {
        $transportadoras = \App\Models\Transportadora::all();
        return view('veiculos.edit', compact('veiculo', 'transportadoras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        $validated = $request->validate([
            'placa' => 'required|unique:veiculos,placa,' . $veiculo->id,
            'tipo' => 'required',
            'modelo' => 'required',
            'transportadora_id' => 'required|exists:transportadoras,id',
            'status_acesso' => 'required|in:ativo,inativo,bloqueado',
        ]);

        $veiculo->update($validated);

        return redirect()
            ->route('veiculos.index')
            ->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();

        return redirect()
            ->route('veiculos.index')
            ->with('success', 'Veículo excluído com sucesso!');
    }
}
