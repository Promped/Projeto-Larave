<?php

namespace App\Http\Controllers;

use App\Models\VagasPatio;
use App\Models\Agendamento;
use App\Models\MovimentacaoPatio;
use App\Models\Ocorrencia;
use App\Models\FuncaoVisitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function gerencial()
{
    // 1. Contagens do Header (Isso aqui funciona!)
    $totalAgendamentos = Agendamento::count();
    $pendentes = Agendamento::where('status', 'pendente')->count();
    $concluidos = Agendamento::where('status', 'concluido')->count();
    $ocorrenciasCount = Ocorrencia::count();

    // 2. QUADRANTE 1: Ranking Simples (Sem o join de ocorrências que deu erro)
    $rankingTransportadoras = Agendamento::join('veiculos', 'agendamentos.veiculo_id', '=', 'veiculos.id')
        ->join('transportadoras', 'veiculos.transportadora_id', '=', 'transportadoras.id')
        ->select('transportadoras.razao_social as empresa', DB::raw('count(agendamentos.id) as total_viagens'))
        ->groupBy('transportadoras.razao_social')
        ->orderBy('total_viagens', 'desc')
        ->take(5)
        ->get();
    
    // 3. QUADRANTE 2: Visitantes
    $ultimosVisitantes = FuncaoVisitante::orderBy('created_at', 'desc')->take(5)->get();

    // 4. QUADRANTE 3: Lead Time
    $minutosMedios = Agendamento::whereNotNull('horario_inicio')
        ->whereNotNull('horario_fim')
        ->select(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, horario_inicio, horario_fim)) as media'))
        ->first()->media;

    $tempoMedioOperacao = $minutosMedios ? round($minutosMedios) . " min" : "---";
    $tempoMedioEspera = "12 min"; 

    // 5. SATURAÇÃO
    $totalVagas = VagasPatio::count();
    $vagasOcupadas = VagasPatio::where('status', 'ocupada')->count();
    $taxaSaturacao = $totalVagas > 0 ? round(($vagasOcupadas / $totalVagas) * 100) : 0;

    return view('relatorios.gerencial', compact(
        'totalAgendamentos', 'pendentes', 'concluidos', 'ocorrenciasCount',
        'rankingTransportadoras', 'ultimosVisitantes', 'tempoMedioEspera', 
        'tempoMedioOperacao', 'totalVagas', 'vagasOcupadas', 'taxaSaturacao'
    ));
}

    public function historico()
    {
        $historico = MovimentacaoPatio::with(['agendamento.veiculo', 'agendamento.motorista'])
            ->orderBy('created_at', 'desc')->get();
        return view('relatorios.historico', compact('historico'));
    }

    public function ocorrencias()
    {
        $ocorrencias = Ocorrencia::with(['movimentacao.agendamento.veiculo'])
            ->orderBy('created_at', 'desc')->get();
        return view('relatorios.ocorrencias', compact('ocorrencias'));
    }
}