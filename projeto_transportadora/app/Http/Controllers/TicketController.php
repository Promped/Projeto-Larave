<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    public function buscar(Request $request)
    {
        // 1. Limpa o CPF
        $cpfBusca = preg_replace('/[^0-9]/', '', $request->busca);

        if (empty($cpfBusca)) {
            return back()->with('error', 'Digite um CPF válido.');
        }

        // 2. Busca o agendamento (Garante que pega o último agendado para esse CPF)
        $agendamento = Agendamento::with(['motorista', 'veiculo', 'carga'])
            ->whereHas('motorista', function($q) use ($cpfBusca) {
                $q->whereRaw("REPLACE(REPLACE(cpf, '.', ''), '-', '') = ?", [$cpfBusca]);
            })
            ->latest()
            ->first();

        if (!$agendamento) {
            return back()->with('error', 'Nenhum agendamento encontrado para este CPF.');
        }

        // 3. GERA O PDF DIRETO (Usa a view tickets.pdf)
        $pdf = Pdf::loadView('tickets.pdf', compact('agendamento'));
        
        return $pdf->stream("ticket_saida_{$agendamento->veiculo->placa}.pdf");
    }

    // Mantemos essa caso você queira apenas visualizar a tela antes de gerar
    public function validar($id)
    {
        $agendamento = Agendamento::with(['motorista', 'veiculo', 'carga'])->findOrFail($id);
        return view('tickets.validar', compact('agendamento'));
    }
}