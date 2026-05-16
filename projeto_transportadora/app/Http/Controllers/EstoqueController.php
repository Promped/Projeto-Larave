<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;
use App\Models\AreaPatio; // Padronizado com a mesma escrita maiúscula do CargaController

class EstoqueController extends Controller
{
    // Lista os insumos
    public function index()
    {
        $insumos = Insumo::all();
        return view('estoque.index', compact('insumos'));
    }

    // Mostra o formulário de criação carregando as áreas
    public function create()
    {
        $areas = AreaPatio::all(); // Atualizado para usar o padrão correto
        return view('estoque.create', compact('areas'));
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

        return redirect()->route('estoque.index')->with('success', 'Insumo adicionado com sucesso!');
    }

    // Carrega o insumo e as áreas disponíveis para edição
    public function edit($id)
    {
        $insumo = Insumo::findOrFail($id);
        $areas = AreaPatio::all(); 
        return view('estoque.edit', compact('insumo', 'areas'));
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

        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $insumo = Insumo::findOrFail($id);
        $insumo->delete();
        return redirect()->route('estoque.index')->with('success', 'Item removido do estoque!');
    }
}