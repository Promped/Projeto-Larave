<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carga;
use App\Models\Veiculo;
use App\Models\Motorista;

class CargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $cargas = Carga::paginate(10);
    return view('cargas.index', compact('cargas'));
}

public function create()
{
    return view('cargas.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'tipo' => 'required|string|max:255',
        'unidade_medida' => 'required|string',
        'descricao' => 'nullable|string',
    ]);

    Carga::create($validated);
    return redirect()->route('cargas.index')->with('success', 'Tipo de carga cadastrado!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carga = Carga::with(['veiculo','motorista'])->findOrFail($id);
        return view('cargas.show', compact('carga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carga = Carga::findOrFail($id);
        $veiculos = Veiculo::all();
        $motoristas = Motorista::all();
        return view('cargas.edit', compact('carga','veiculos','motoristas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $carga = Carga::findOrFail($id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'peso' => 'nullable|numeric',
            'volume' => 'nullable|numeric',
            'origem' => 'nullable|string',
            'destino' => 'nullable|string',
            'veiculo_id' => 'nullable|exists:veiculos,id',
            'motorista_id' => 'nullable|exists:motoristas,id',
        ]);

        $carga->update($validated);
        return redirect()->route('cargas.index')->with('success','Carga atualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carga = Carga::findOrFail($id);
        $carga->delete();
        return redirect()->route('cargas.index')->with('success','Carga excluída');
    }
}
