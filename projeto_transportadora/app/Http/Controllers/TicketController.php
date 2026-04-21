<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    /**
     * Esta função agora decide: 
     * Se veio ID, gera PDF. 
     * Se veio CPF no campo 'busca', encontra o agendamento e gera o PDF DIRETO.
     */
    public function buscar(Request $request, $id = null)
    {
        // 1. Caso o clique venha de uma URL que já tem o ID
        $idFinal = $id ?? $request->route('id');

        if ($idFinal) {
            return $this->gerarPdf($idFinal);
        }

        // 2. Caso venha do botão BUSCAR do Painel (via campo 'busca')
        $cpfBusca = preg_replace('/[^0-9]/', '', $request->busca);

        if (empty($cpfBusca)) {
            return back()->with('error', 'Informe um CPF.');
        }

        // Busca o último agendamento vinculado a esse CPF
        $agendamento = Agendamento::whereHas('motorista', function($q) use ($cpfBusca) {
                $q->whereRaw("REPLACE(REPLACE(cpf, '.', ''), '-', '') = ?", [$cpfBusca]);
            })
            ->latest()
            ->first();

        if (!$agendamento) {
            return back()->with('error', 'Motorista não encontrado.');
        }

        // --- O PULO DO GATO ---
        // Em vez de dar 'return redirect', chamamos a função do PDF direto aqui!
        return $this->gerarPdf($agendamento->id);
    }

    public function validar($id)
    {
        // Esta função só será usada se você acessar a URL de validar manualmente
        $agendamento = Agendamento::with(['motorista', 'veiculo', 'carga'])->findOrFail($id);
        return view('tickets.validar', compact('agendamento'));
    }

    public function gerarPdf($id)
    {
        $agendamento = Agendamento::with(['motorista', 'veiculo', 'carga'])->findOrFail($id);
        
        // Carrega a view do PDF
        $pdf = Pdf::loadView('tickets.pdf', compact('agendamento'));
        
        // stream() faz abrir no navegador. Se quiser que baixe, use download()
        return $pdf->stream("ticket_entrada_{$id}.pdf");
    }
}