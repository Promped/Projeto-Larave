<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;      // Mapeia o estoque real (Tabela onde fica a 'Madeira')
use App\Models\Carga;       // Histórico de cargas do pátio
use App\Models\Composicao;
use Illuminate\Support\Facades\DB;

class ComposicaoController extends Controller
{
    // Exibe a tela com o formulário de montagem
    public function create()
    {
        // Puxa todos os insumos cadastrados no estoque para evitar erros se a tabela estiver vazia
        $insumos = Insumo::all();
        
        // Se não houver NENHUM insumo cadastrado no sistema, envia um aviso para a view
        if ($insumos->isEmpty()) {
            session()->now('warning', 'Atenção: Não existem insumos cadastrados no Controle de Estoque Central. Cadastre um insumo antes de realizar a montagem.');
        }

        return view('cargas.montar', compact('insumos'));
    }

    // Processa a montagem do produto operando baixas e entradas no estoque
    public function store(Request $request)
    {
        $request->validate([
            'insumo_origem_id'     => 'required|exists:insumos,id',
            'quantidade_usada'     => 'required|numeric|min:0.01',
            'produto_resultante'   => 'required|string|max:255',
            'quantidade_produzida' => 'required|numeric|min:0.01',
        ]);

        // Busca o insumo de origem para validar o saldo em estoque
        $insumoOrigem = Insumo::findOrFail($request->insumo_origem_id);

        // Validação preventiva para o TCC: impede retirar mais do que existe no pátio
        if ($insumoOrigem->quantidade_atual < $request->quantidade_usada) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quantidade_usada' => "Saldo insuficiente! O estoque atual de '{$insumoOrigem->nome}' é de {$insumoOrigem->quantidade_atual} {$insumoOrigem->unidade_medida}."]);
        }

        // Executa a transação no banco de dados para garantir consistência total
        DB::transaction(function () use ($request, $insumoOrigem) {
            
            // 1. Deduz a quantidade usada do Insumo de Origem
            $insumoOrigem->quantidade_atual -= $request->quantidade_usada;
            $insumoOrigem->save();

            // 2. Adiciona ou atualiza o Produto Resultante no Estoque Real
            $produtoEstoque = Insumo::where('nome', $request->produto_resultante)->first();

            if ($produtoEstoque) {
                $produtoEstoque->quantidade_atual += $request->quantidade_produzida;
                
                // Impede que ultrapasse o limite máximo configurado para aquela capacidade
                if ($produtoEstoque->quantidade_atual > $produtoEstoque->limite_maximo) {
                    $produtoEstoque->quantidade_atual = $produtoEstoque->limite_maximo;
                }
                $produtoEstoque->save();
            } else {
                // Se o produto montado não existir, cria ele no estoque central
                Insumo::create([
                    'nome'              => $request->produto_resultante,
                    'local_armazenagem' => $insumoOrigem->local_armazenagem, 
                    'quantidade_atual'  => $request->quantidade_produzida,
                    'quantidade_minima' => 0,
                    'limite_maximo'     => $insumoOrigem->limite_maximo ?? 1000, 
                    'unidade_medida'    => 'UN', 
                ]);
            }

            // 3. Registra o histórico na tabela de composições
            Composicao::create([
                'carga_origem_id'      => $insumoOrigem->id, 
                'quantidade_usada'     => $request->quantidade_usada,
                'produto_resultante'   => $request->produto_resultante,
                'quantidade_produzida' => $request->quantidade_produzida,
            ]);

            // 4. Registra na tabela informativa de cargas gerais do pátio
            Carga::create([
                'tipo'           => $request->produto_resultante,
                'unidade_medida' => 'UN',
                'descricao'      => "Produto composto produzido a partir de: " . $insumoOrigem->nome,
            ]);
        });

        return redirect()->route('estoque.index')->with('success', 'Montagem realizada! O estoque de insumos foi baixado e o produto final foi adicionado.');
    }
}