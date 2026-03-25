<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;

class ProducaoController extends Controller
{
    public function index()
    {
        $insumos = Insumo::all();
        return view('producao.index', compact('insumos'));
    }

    public function baixarEstoque(Request $request)
    {
        $insumo = Insumo::findOrFail($request->insumo_id);
        
        // Verifica se tem estoque suficiente antes de produzir
        if ($insumo->quantidade_atual < $request->quantidade_usada) {
            return back()->with('erro', 'Estoque insuficiente para produzir!');
        }

        // F_F09: Subtrai a quantidade usada da matéria-prima
        $insumo->quantidade_atual -= $request->quantidade_usada;
        $insumo->save();

        return redirect()->route('producao.index')->with('sucesso', 'Produção finalizada e estoque atualizado!');
    }
}