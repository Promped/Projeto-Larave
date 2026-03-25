@extends('layout')

@section('content')
<div class="container mx-auto pb-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Painel Geral de Operações</h1>
        <p class="text-gray-600">Status de ocupação e fluxo do pátio em tempo real.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        @foreach($areas as $area)
        <div class="bg-white rounded-xl shadow-md border-l-4 {{ $area->ocupacao_percent >= 90 ? 'border-red-500' : 'border-blue-500' }} p-5">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">{{ $area->nome }}</h3>
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Área de Estacionamento</p>
                </div>
                <span class="px-2 py-1 rounded text-xs font-bold {{ $area->ocupacao_percent >= 90 ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ number_format($area->ocupacao_percent, 0) }}% Ocupado
                </span>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">🚛 Veículos no Local:</span>
                    <span class="font-bold text-gray-800">{{ $area->veiculos_atual }} / {{ $area->vagas_totais }}</span>
                </div>
                
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="h-2.5 rounded-full {{ $area->ocupacao_percent >= 90 ? 'bg-red-500' : 'bg-blue-600' }}" 
                         style="width: {{ $area->ocupacao_percent }}%"></div>
                </div>
                
                <p class="text-xs {{ $area->ocupacao_percent >= 90 ? 'text-red-600 font-bold' : 'text-gray-500' }}">
                    {{ $area->ocupacao_percent >= 90 ? '⚠️ Capacidade Crítica!' : '✅ Espaço Disponível' }}
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Fluxo de Entradas Mensais</h3>
        <canvas id="meuGrafico" height="100"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('meuGrafico').getContext('2d');
    new Chart(ctx, {
        type: 'line', // Mudei para linha para variar o visual do dashboard
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
            datasets: [{
                label: 'Veículos Processados',
                data: [45, 52, 80, 65, 95],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection