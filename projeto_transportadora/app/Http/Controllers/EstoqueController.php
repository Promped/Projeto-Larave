<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;

class EstoqueController extends Controller
{
    // Lista os insumos
    public function index()
    {
        $insumos = Insumo::all();
        return view('estoque.index', compact('insumos'));
    }

    // ESSA É A FUNÇÃO QUE ESTÁ FALTANDO NO SEU ERRO:
    public function create()
    {
        return view('estoque.create');
    }

    // Salva o novo insumo
    public function store(Request $request)
    {
        $request->validate([
            'nome'              => 'required|string|max:255',
            'local_armazenagem' => 'required|string',
            'quantidade_atual'  => 'required|numeric|min:0',
            'quantidade_minima' => 'required|numeric|min:0',
            'limite_maximo'     => 'required|numeric|min:1',
            'unidade_medida'    => 'required|string',
        ]);

        Insumo::create($request->all());

        return redirect()->route('estoque.index')->with('success', 'Insumo adicionado!');
    }

    public function edit($id)
    {
        $insumo = Insumo::findOrFail($id);
        return view('estoque.edit', compact('insumo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome'              => 'required|string|max:255',
            'local_armazenagem' => 'required|string',
            'quantidade_atual'  => 'required|numeric|min:0',
            'quantidade_minima' => 'required|numeric|min:0',
            'limite_maximo'     => 'required|numeric|min:1',
            'unidade_medida'    => 'required|string',
        ]);

        $insumo = Insumo::findOrFail($id);
        $insumo->update($request->all());

        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado!');
    }

    public function destroy($id)
    {
        $insumo = Insumo::findOrFail($id);
        $insumo->delete();
        return redirect()->route('estoque.index')->with('success', 'Item removido!');
    }
}