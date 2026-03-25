@extends('layout')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Painel de Controle</h1>

    {{-- Cards Superiores --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 shadow-sm">
            <p class="text-blue-600 font-semibold uppercase text-xs">Veículos</p>
            <h2 class="text-3xl font-bold text-blue-800">{{ $stats['total_veiculos'] }}</h2>
        </div>
        <div class="bg-green-50 p-6 rounded-xl border border-green-100 shadow-sm">
            <p class="text-green-600 font-semibold uppercase text-xs">Motoristas</p>
            <h2 class="text-3xl font-bold text-green-800">{{ $stats['total_motoristas'] }}</h2>
        </div>
        <div class="bg-purple-50 p-6 rounded-xl border border-purple-100 shadow-sm">
            <p class="text-purple-600 font-semibold uppercase text-xs">Transportadoras</p>
            <h2 class="text-3xl font-bold text-purple-800">{{ $stats['total_transportadoras'] }}</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Gráfico de Barras --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-700 mb-4">📊 Volume por Insumo</h3>
            <canvas id="estoqueChart" height="200"></canvas>
        </div>

        {{-- Gráfico de Pizza com Alerta --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-700 mb-4 text-center">🍕 Ocupação Total: {{ number_format($percentual, 1) }}%</h3>
            <div style="height: 220px;">
                <canvas id="pizzaChart"></canvas>
            </div>
            <div class="mt-4 text-center text-sm">
                @if($percentual >= 90)
                    <span class="text-red-600 font-bold">⚠️ CAPACIDADE CRÍTICA</span>
                @elseif($percentual >= 70)
                    <span class="text-yellow-600 font-bold">⚠️ ATENÇÃO: ESPAÇO REDUZIDO</span>
                @else
                    <span class="text-green-600 font-bold">✅ ESPAÇO DISPONÍVEL</span>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuração de Cores Dinâmicas
    const percent = {{ $percentual }};
    let corOcupado = '#10b981'; // Verde (padrão)
    if (percent >= 90) corOcupado = '#ef4444'; // Vermelho
    else if (percent >= 70) corOcupado = '#f59e0b'; // Amarelo

    // Gráfico Pizza/Doughnut
    new Chart(document.getElementById('pizzaChart'), {
        type: 'doughnut',
        data: {
            labels: ['Ocupado', 'Livre'],
            datasets: [{
                data: {!! json_encode($dadosPizza) !!},
                backgroundColor: [corOcupado, '#e5e7eb'],
                borderWidth: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Gráfico de Barras
    new Chart(document.getElementById('estoqueChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Qtd Atual',
                data: {!! json_encode($valores) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.7)'
            }]
        }
    });
</script>
@endsection