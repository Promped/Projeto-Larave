<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento; // Ou MovimentacaoPatio, dependendo de onde você salva

class RelatorioController extends Controller
{
    public function historico()
    {
        // Pega todos os agendamentos com os nomes dos veículos e motoristas
        $historico = Agendamento::with(['veiculo', 'motorista'])->orderBy('created_at', 'desc')->get();
        
        return view('relatorios.historico', compact('historico'));
    }
}