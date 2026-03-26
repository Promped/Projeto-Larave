<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\MovimentacaoPatio;
use App\Models\Ocorrencia;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    /**
     * F_S01: Painel Geral (Dashboard)
     * Alinhado com gerencial.blade.php
     */
    public function gerencial()
    {
        // 1. Contagens para os cards
        $totalAgendamentos = Agendamento::count();
        $pendentes = Agendamento::where('status', 'pendente')->count();
        $concluidos = Agendamento::where('status', 'concluido')->count();
        $ocorrencias = Ocorrencia::count();

        // 2. Lista para o "Histórico Rápido" (Últimos 5 registros)
        $ultimosAgendamentos = Agendamento::with(['veiculo', 'motorista'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Retorno para a view com todas as variáveis necessárias
        return view('relatorios.gerencial', compact(
            'totalAgendamentos',
            'pendentes',
            'concluidos',
            'ocorrencias',
            'ultimosAgendamentos'
        ));
    }

    /**
     * F_S02: Histórico de Movimentação Real (Pátio)
     */
    public function historico()
    {
        $historico = MovimentacaoPatio::with(['agendamento.veiculo', 'agendamento.motorista'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('relatorios.historico', compact('historico'));
    }

    /**
     * F_F04: Tela de Gestão de Ocorrências
     */
    public function ocorrencias()
{
    // O with ajuda a carregar os dados do veículo pra não dar erro na tabela
    $ocorrencias = \App\Models\Ocorrencia::with(['movimentacao.agendamento.veiculo'])
        ->orderBy('created_at', 'desc')
        ->get(); // SEM ISSO A TELA FICA BRANCA

    return view('relatorios.ocorrencias', compact('ocorrencias'));
}
}