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
    $insumo = App\Models\Insumo::findOrFail($request->insumo_id);
    
    if ($insumo->quantidade_atual < $request->quantidade_usada) {
        // Redireciona com erro se tentar usar mais do que tem no pátio/almoxarifado
        return back()->with('erro', 'Saldo insuficiente!'); 
    }

    $insumo->quantidade_atual -= $request->quantidade_usada;
    $insumo->save();

    return back()->with('sucesso', 'Estoque atualizado com sucesso!');
}
}