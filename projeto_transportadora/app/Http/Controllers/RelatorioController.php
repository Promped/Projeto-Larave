<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\GerenciamentoPatio; // Ajuste o nome conforme o seu Model de Ocorrências

class RelatorioController extends Controller
{
    public function historico()
    {
        $historico = Agendamento::with(['veiculo', 'motorista'])->orderBy('created_at', 'desc')->get();
        return view('relatorios.historico', compact('historico'));
    }

    public function gerencial()
    {
        // Contagens de Agendamentos (F_F01)
        $totalAgendamentos = Agendamento::count();
        $pendentes = Agendamento::where('status', 'pendente')->count();
        $concluidos = Agendamento::where('status', 'concluido')->count();

        // NOVO: Contagem de Ocorrências (F_F04)
        // Se a sua tabela for 'ocorrencias_patio', use o model correspondente
        $ocorrencias = \DB::table('ocorrencias_patio')->count(); 

        // Últimas movimentações
        $ultimosAgendamentos = Agendamento::with(['veiculo'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('relatorios.gerencial', compact(
            'totalAgendamentos', 
            'pendentes', 
            'concluidos', 
            'ocorrencias', 
            'ultimosAgendamentos'
        ));
    }
}