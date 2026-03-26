<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Veiculo;
use App\Models\Motorista;
use App\Models\Carga;
use App\Models\Ocorrencia;
use App\Models\VagasPatio; 
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamento::with(['veiculo', 'motorista', 'carga', 'vaga'])
            ->orderBy('data_agendamento', 'asc')
            ->paginate(10);

        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        $veiculos = Veiculo::all();
        $motoristas = Motorista::all();
        $cargas = Carga::all();
        $vagas = VagasPatio::all(); 

        return view('agendamentos.create', compact('veiculos', 'motoristas', 'cargas', 'vagas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'veiculo_id' => 'required',
            'motorista_id' => 'required',
            'carga_id' => 'required',
            'vaga_id' => 'required', 
            'data_agendamento' => 'required|date',
            'horario_inicio' => 'required', // Adicionado
            'horario_fim' => 'required',    // Adicionado
        ]);

        $veiculo = Veiculo::findOrFail($request->veiculo_id);
        $motorista = Motorista::findOrFail($request->motorista_id);

        // --- TRAVA DE VEÍCULO ---
        $statusVeiculo = trim(strtolower($veiculo->status_acesso));

        if ($statusVeiculo !== 'ativo') {
            $statusAtual = $veiculo->status_acesso ?: 'Sem Status';
            
            Ocorrencia::create([
                'tipo' => 'nao_conformidade',
                'descricao' => "BLOQUEIO F_F01: Veículo {$veiculo->placa} negado. Status: {$statusAtual}.",
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error_bloqueio', "🚫 O veículo {$veiculo->placa} não pode ser agendado pois está com status: {$statusAtual}.");
        }

        // --- TRAVA DE MOTORISTA ---
        // IMPORTANTE: Se no banco for 'status_acesso', mude de $motorista->status para $motorista->status_acesso
        $statusMotorista = trim(strtolower($motorista->status));

        if ($statusMotorista !== 'ativo') {
            $statusMot = $motorista->status ?: 'Sem Status';

            Ocorrencia::create([
                'tipo' => 'nao_conformidade',
                'descricao' => "BLOQUEIO F_F01: Motorista {$motorista->nome} negado. Status: {$statusMot}.",
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error_bloqueio', "🚫 O motorista {$motorista->nome} está {$statusMot}. Agendamento não permitido.");
        }

        // SALVAMENTO (Incluindo os horários que vêm da sua View)
        Agendamento::create([
            'veiculo_id' => $request->veiculo_id,
            'motorista_id' => $request->motorista_id,
            'carga_id' => $request->carga_id,
            'vaga_id' => $request->vaga_id,
            'data_agendamento' => $request->data_agendamento,
            'horario_inicio' => $request->horario_inicio, // Adicionado
            'horario_fim' => $request->horario_fim,       // Adicionado
            'status' => 'pendente'
        ]);

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento realizado com sucesso!');
    }

    public function edit($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $veiculos = Veiculo::all();
        $motoristas = Motorista::all();
        $cargas = Carga::all();
        $vagas = VagasPatio::all();

        return view('agendamentos.edit', compact('agendamento', 'veiculos', 'motoristas', 'cargas', 'vagas'));
    }

    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->update($request->all());

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento atualizado!');
    }

    public function destroy($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento removido.');
    }
}