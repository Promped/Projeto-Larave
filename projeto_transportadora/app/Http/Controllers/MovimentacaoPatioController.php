<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentacaoPatio;
use App\Models\Insumo; 
use App\Models\Agendamento;
use App\Models\Ocorrencia;
use Illuminate\Support\Facades\DB;

class MovimentacaoPatioController extends Controller
{ 
    // 1. LISTAGEM (Mostra apenas quem está dentro do pátio operando)
    public function index()
    {
        // No index do MovimentacaoPatioController
            $movimentacoes = MovimentacaoPatio::with('agendamento.veiculo', 'agendamento.motorista', 'agendamento.carga')
                ->whereNotIn('status', ['Finalizado', 'Saída Realizada', 'Concluído']) 
                ->get();

        return view('movimentacoes.index', compact('movimentacoes'));
    }

    // 2. TELA DE ENTRADA (Filtra quem realmente está aguardando)
    public function create()
    {
        $agendamentosPendentes = Agendamento::with(['veiculo', 'motorista', 'carga'])
            ->where('status', 'pendente') // Se já entrou, vira 'No Pátio' e some daqui
            ->get();
            
        return view('movimentacoes.create', compact('agendamentosPendentes'));
    }

    // 3. SALVAR ENTRADA (A trava de segurança está aqui)
    public function store(Request $request)
    {
        $agendamento = Agendamento::with('veiculo')->findOrFail($request->agendamento_id);
        
        // Verifica o status do veículo (ajuste para sua coluna do banco: status_acesso ou status)
        $statusVeiculoRaw = $agendamento->veiculo->status_acesso ?? $agendamento->veiculo->status;
        $statusFormatado = trim(strtolower($statusVeiculoRaw));

        $foiAutorizado = ($statusFormatado === 'ativo');

        // Cria a movimentação
        $movimentacao = MovimentacaoPatio::create([
            'agendamento_id' => $request->agendamento_id,
            'horario_entrada' => now(),
            'status' => $foiAutorizado ? 'Em Espera' : 'Ocorrência'
        ]);

        if (!$foiAutorizado) {
            Ocorrencia::create([
                'movimentacao_id' => $movimentacao->id,
                'tipo' => 'nao_conformidade',
                'descricao' => "BLOQUEIO PORTARIA: Veículo {$agendamento->veiculo->placa} tentou entrar mas está com status: {$statusVeiculoRaw}.",
            ]);

            return redirect()->route('movimentacoes.index')
                ->with('error', "ENTRADA NEGADA! Veículo bloqueado. Ocorrência gerada.");
        }

        // SE PASSOU: Atualiza o agendamento para ele sair da lista da portaria
        $agendamento->update(['status' => 'No Pátio']);

        return redirect()->route('movimentacoes.index')->with('success', 'Entrada autorizada no sistema!');
    }

    // 4. TELA DE EDIÇÃO (Gerenciar status e peso)
    public function edit($id)
    {
        $movimentacao = MovimentacaoPatio::with('agendamento.carga')->findOrFail($id);
        return view('movimentacoes.edit', compact('movimentacao'));
    }

    // 5. UPDATE (Decide se apenas muda o status ou finaliza carga)
    public function update(Request $request, $id)
    {
        if ($request->status == 'Finalizado') {
            return $this->finalizarDescarga($request, $id);
        }

        $mov = MovimentacaoPatio::findOrFail($id);
        $mov->update(['status' => $request->status]);

        return redirect()->route('movimentacoes.index')->with('success', 'Status atualizado!');
    }

    // 6. REGISTRAR SAÍDA (Faz o veículo sumir do F_F03 e encerra o ciclo)
    public function registrarSaida($id)
    {
        $mov = MovimentacaoPatio::findOrFail($id);
        
        $mov->update([
            'status' => 'Saída Realizada',
            'horario_saida' => now()
        ]);

        // Fecha o agendamento para sempre
        $mov->agendamento->update(['status' => 'concluido']);

        return redirect()->route('movimentacoes.index')->with('success', 'Saída confirmada! Veículo liberado.');
    }

    // 7. LÓGICA DE ESTOQUE (Privada para segurança)
    private function finalizarDescarga(Request $request, $id)
    {
        $movimentacao = MovimentacaoPatio::with('agendamento.carga')->findOrFail($id);
        $nomeCarga = $movimentacao->agendamento->carga->tipo; 
        $pesoDescarga = $request->peso_real_descarga;

        return DB::transaction(function () use ($movimentacao, $nomeCarga, $pesoDescarga) {
            $estoqueItem = Insumo::where('nome', $nomeCarga)->first();

            if (!$estoqueItem) {
                $movimentacao->update(['status' => 'Ocorrência']);
                Ocorrencia::create([
                    'movimentacao_id' => $movimentacao->id,
                    'tipo' => 'estoque',
                    'descricao' => "ERRO ESTOQUE: Insumo '$nomeCarga' não cadastrado no F_F08.",
                ]);
                return redirect()->route('movimentacoes.index')->with('error', 'Erro: Insumo não encontrado no estoque.');
            }

            $estoqueItem->increment('quantidade_atual', $pesoDescarga);
            
            $movimentacao->update([
                'status' => 'Finalizado',
                'peso_real_descarga' => $pesoDescarga
            ]);

            return redirect()->route('movimentacoes.index')->with('success', 'Carga processada e estoque atualizado!');
        });
    }
}