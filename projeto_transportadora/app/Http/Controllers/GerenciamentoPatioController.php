<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\MovimentacaoPatio;
use App\Models\OcorrenciaPatio;
use Illuminate\Support\Facades\Auth;

class GerenciamentoPatioController extends Controller
{
    // Métodos para exibir as telas (Views)
    public function indexAgendamento() { 
        return view('Gerenciamento_patio.agendamento_carga'); 
    }

    public function indexEntrada() { 
        return view('Gerenciamento_patio.entrada_patio'); 
    }

    public function indexOcorrencia() { 
        return view('Gerenciamento_patio.ocorrencia'); 
    }

    public function indexSaida() { 
        return view('Gerenciamento_patio.saida'); 
    }

    // F_F01 - Salvar Agendamento
    public function storeAgendamento(Request $request) {
        $request->validate([
            'veiculo_id' => 'required',
            'data_hora_prevista' => 'required',
            'doca' => 'required'
        ]);

        $conflito = Agendamento::where('doca', $request->doca)
            ->where('data_hora_prevista', $request->data_hora_prevista)
            ->exists();

        if ($conflito) {
            return back()->with('error', 'Conflito: Já existe um agendamento para esta doca neste horário.');
        }

        Agendamento::create($request->all());
        return back()->with('success', 'Agendamento realizado com sucesso!');
    }

    // F_F03 - Registrar Entrada
    public function storeEntrada(Request $request) {
        MovimentacaoPatio::create([
            'veiculo_id' => $request->veiculo_id,
            'data_hora_entrada' => now(),
            'user_id_responsavel' => Auth::id(),
            'protocolo_auditoria' => 'ENT-' . time()
        ]);
        return back()->with('success', 'Entrada registrada com sucesso!');
    }
}