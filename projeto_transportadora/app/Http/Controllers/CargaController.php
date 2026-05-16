<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carga;
use App\Models\AreaPatio;
use App\Models\Veiculo;         
use App\Models\Motorista;       
use App\Models\Transportadora; 
use App\Models\Estoque; 

class CargaController extends Controller
{
    /**
     * Exibe a listagem de cargas ou o Dashboard administrativo
     */
    public function index()
    {
        $stats = [
            'total_veiculos' => Veiculo::count(),
            'total_motoristas' => Motorista::count(),
            'total_transportadoras' => Transportadora::count(),
        ];

        // 1. Dados das Barras (Individual)
        $dadosBarras = Estoque::selectRaw('nome as label, SUM(quantidade_atual) as total')
            ->groupBy('nome')
            ->get();

        // 2. Dados da Pizza (Ocupação Total vs Limite X)
        $estoqueGeral = Estoque::selectRaw('SUM(quantidade_atual) as ocupado, SUM(limite_maximo) as limite')
            ->first();

        $totalOcupado = $estoqueGeral->ocupado ?? 0;
        $limiteTotal = $estoqueGeral->limite ?? 100;
        $espacoLivre = max(0, $limiteTotal - $totalOcupado);
        
        // Calcula a porcentagem para o alerta
        $percentualOcupado = $limiteTotal > 0 ? ($totalOcupado / $limiteTotal) * 100 : 0;

        // 3. Ocupação das Áreas (Pátio)
        $areas = AreaPatio::all()->map(function($area) {
            $area->veiculos_atual = 0; 
            $area->vagas_totais = $area->capacidade ?? 10;
            $area->ocupacao_percent = $area->vagas_totais > 0 
                ? ($area->veiculos_atual / $area->vagas_totais) * 100 
                : 0;
            return $area;
        });

        // Lógica para decidir se exibe o Dashboard ou a listagem de Cargas
        if (request()->routeIs('admin.dashboard') || request()->routeIs('inicial-adm') || request()->path() == 'meu-painel') {
            return view('dashboard', [
                'stats' => $stats,
                'areas' => $areas,
                'labels' => $dadosBarras->pluck('label'), 
                'valores' => $dadosBarras->pluck('total'),
                'dadosPizza' => [$totalOcupado, $espacoLivre],
                'percentual' => $percentualOcupado,
                'limiteTotal' => $limiteTotal
            ]);
        }

        return view('cargas.index', ['cargas' => Carga::paginate(10)]);
    }

    /**
     * Exibe o formulário de criação de nova carga
     */
    public function create()
    {
        return view('cargas.create');
    }

    /**
     * Salva a nova carga no banco de dados
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'unidade_medida' => 'required|string',
        ]);

        Carga::create($request->all());

        return redirect()->route('cargas.index')->with('success', 'Material cadastrado com sucesso!');
    }

    /**
     * COMPONENTE ADICIONADO: Abre a tela de edição trazendo os dados da carga
     */
    public function edit($id)
    {
        $carga = Carga::findOrFail($id);
        return view('cargas.edit', compact('carga'));
    }

    /**
     * COMPONENTE ADICIONADO: Executa a atualização dos dados no banco
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'unidade_medida' => 'required|string',
        ]);

        $carga = Carga::findOrFail($id);
        $carga->update($request->all());

        return redirect()->route('cargas.index')->with('success', 'Material atualizado com sucesso!');
    }

    /**
     * COMPONENTE ADICIONADO: Remove o material do sistema
     */
    public function destroy($id)
    {
        $carga = Carga::findOrFail($id);
        $carga->delete();

        return redirect()->route('cargas.index')->with('success', 'Material excluído do sistema!');
    }
}