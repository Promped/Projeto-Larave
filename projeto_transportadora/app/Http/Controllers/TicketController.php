<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Importante: certifique-se de ter instalado o barryvdh/laravel-dompdf

class TicketController extends Controller
{
    // Mostra a tela para o motorista digitar o CPF (Na mesma página)
    public function showValidar($id)
    {
        $agendamento = Agendamento::with(['motorista', 'veiculo'])->findOrFail($id);
        return view('tickets.validar', compact('agendamento'));
    }

    // Lógica para validar CPF e gerar o PDF real
    public function gerarTicket(Request $request, $id)
    {
        $agendamento = Agendamento::with(['motorista', 'veiculo', 'carga'])->findOrFail($id);
        
        // Limpa a formatação do CPF para comparar apenas números
        $cpfInput = preg_replace('/[^0-9]/', '', $request->cpf);
        $cpfMotorista = preg_replace('/[^0-9]/', '', $agendamento->motorista->cpf);

        // Validação de segurança
        // Se o CPF for DIFERENTE, barramos
            if ($cpfInput !== $cpfMotorista) {
                return back()->with('error', 'O CPF digitado não confere com o motorista deste veículo.');
            }

            // Se chegou aqui, é porque o CPF é IGUAL. Então geramos o PDF:
            $pdf = Pdf::loadView('tickets.pdf', compact('agendamento'));
            return $pdf->stream('ticket.pdf');

        // Gera o PDF usando a view tickets.pdf
        $pdf = Pdf::loadView('tickets.pdf', compact('agendamento'));

        // Nome do arquivo: ticket_PLACA_HORA.pdf
        $nomeArquivo = "ticket_" . ($agendamento->veiculo->placa ?? 'sem_placa') . "_" . now()->format('Hi') . ".pdf";

        // .stream() abre no navegador, .download() baixa direto
        return $pdf->stream($nomeArquivo);
    }
}