<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{MovimentacaoPatio, Liberacao};
use Illuminate\Support\Facades\Auth;

class LiberacaoController extends Controller
{
    // Lista quem está em processo de saída
    public function index() {
    // Só aparece no F_F05 quem já teve o status 'Finalizado' no pátio (F_F03)
    // Mas que ainda não atravessou o portão principal (horario_saida é null)
    // No index do LiberacaoController
$pendentes = MovimentacaoPatio::where('status', 'Finalizado')
    ->whereNull('horario_saida')
    ->with(['agendamento.veiculo', 'agendamento.motorista'])
    ->get();

    return view('Liberacao.index', compact('pendentes'));
}

    // Exibe o Check-list
    public function show($id) {
        $movimentacao = MovimentacaoPatio::with(['agendamento.veiculo', 'agendamento.motorista'])->findOrFail($id);
        return view('Liberacao.conferencia', compact('movimentacao'));
    }

    // Salva a liberação
    public function store(Request $request, $id)
{
    $mov = MovimentacaoPatio::findOrFail($id);

    // 1. Finaliza a movimentação com data e hora
    $mov->update([
        'status' => 'Saída Realizada',
        'horario_saida' => now(),
        'observacoes' => $request->observacoes
    ]);

    // 2. AQUI ESTÁ A CHAVE: Atualiza o AGENDAMENTO para 'concluido'
    // É esse status que o F_S01 (Gerencial) lê para mostrar a tag verde
    $mov->agendamento->update(['status' => 'concluido']);

    // 3. Redireciona para gerar o PDF (veremos abaixo)
    return redirect()->route('ticket.validar.view', $mov->agendamento->id);
}
    public function comprovante($id) {
        $mov = MovimentacaoPatio::with(['agendamento.veiculo', 'agendamento.motorista'])->findOrFail($id);
        return view('patio.liberacao.comprovante', compact('mov'));
    }
}