<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    /**
     * BUSCA E GERA O PDF DIRETO
     */
    public function buscar(Request $request)
    {
        // 1. Limpa o CPF do input
        $cpfBusca = preg_replace('/[^0-9]/', '', $request->busca);

        if (empty($cpfBusca)) {
            return back()->with('error', 'Digite um CPF para buscar.');
        }

        // 2. Busca o agendamento mais recente (independente de status para garantir que ache)
        $agendamento = Agendamento::with(['motorista', 'veiculo', 'carga'])
            ->whereHas('motorista', function($q) use ($cpfBusca) {
                $q->whereRaw("REPLACE(REPLACE(cpf, '.', ''), '-', '') = ?", [$cpfBusca]);
            })
            ->latest()
            ->first();

        // 3. Se não achar, volta com erro
        if (!$agendamento) {
            return back()->with('error', 'Nenhum registro encontrado para o CPF: ' . $request->busca);
        }

        // 4. GERA O PDF NA HORA E EXIBE NO NAVEGADOR
        // Certifique-se que o arquivo está em: resources/views/tickets/pdf.blade.php
        $pdf = Pdf::loadView('tickets.pdf', compact('agendamento'));
        
        $nomeArquivo = "comprovante_" . ($agendamento->veiculo->placa ?? 'saida') . ".pdf";

        return $pdf->stream($nomeArquivo);
    }

    // Estas funções abaixo agora são inúteis para o seu fluxo atual, 
    // mas pode deixar aí ou apagar se quiser limpar o código.
    public function showValidar($id) { return redirect()->route('admin.dashboard'); }
    public function gerarTicket(Request $request, $id) { return redirect()->route('admin.dashboard'); }
}