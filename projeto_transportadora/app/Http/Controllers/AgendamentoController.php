<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Veiculo;
use App\Models\Motorista;
use App\Models\VagasPatio;
use App\Models\Carga;

class AgendamentoController extends Controller
{
    public function index()
    {
        // Carrega os agendamentos com os relacionamentos para a tabela ficar completa
        $agendamentos = Agendamento::with(['veiculo', 'motorista', 'vaga.area'])->get();
        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        // Busca os dados dos cadastros base (F_B01, F_B02, F_B03, F_B07)
        $veiculos = Veiculo::all();
        $motoristas = Motorista::all();
        $cargas = Carga::all();
        
        // Carrega as vagas e suas respectivas áreas para o select
        $vagas = VagasPatio::with('area')->get();

        return view('agendamentos.create', compact('veiculos', 'motoristas', 'cargas', 'vagas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'veiculo_id' => 'required',
            'motorista_id' => 'required',
            'vaga_id' => 'required',
            'data_agendamento' => 'required|date',
            'horario_inicio' => 'required',
            'horario_fim' => 'required|after:horario_inicio',
        ]);

        // REGRA DE NEGÓCIO F_F01: Controlar conflitos e sobreposição
        $conflito = Agendamento::where('vaga_id', $request->vaga_id)
            ->where('data_agendamento', $request->data_agendamento)
            ->where(function ($query) use ($request) {
                $query->whereBetween('horario_inicio', [$request->horario_inicio, $request->horario_fim])
                      ->orWhereBetween('horario_fim', [$request->horario_inicio, $request->horario_fim])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('horario_inicio', '<=', $request->horario_inicio)
                            ->where('horario_fim', '>=', $request->horario_fim);
                      });
            })->exists();

        if ($conflito) {
            return back()->withErrors(['vaga_id' => 'Esta vaga já possui um agendamento para este período.'])->withInput();
        }

        Agendamento::create($request->all());

        return redirect()->route('agendamentos.index')->with('sucesso', 'Agendamento realizado com sucesso!');
    }
}